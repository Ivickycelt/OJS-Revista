import React, { useCallback, useState } from 'react';
import { ActivityIndicator, Image, Linking, Pressable, ScrollView, Text, View } from 'react-native';
import { useFocusEffect } from '@react-navigation/native';
import { api } from '../api';
import { useAuth } from '../auth';
import Estado from '../components/Estado';
import { urlAbsoluta } from '../config';
import { colores, estilos } from '../theme';

export default function ArticuloScreen({ route, navigation }) {
  const { id } = route.params;
  const { token } = useAuth();
  const [articulo, setArticulo] = useState(null);
  const [esFavorito, setEsFavorito] = useState(false);
  const [cargando, setCargando] = useState(true);
  const [error, setError] = useState(null);
  const [portadaFallo, setPortadaFallo] = useState(false);
  const [ocupado, setOcupado] = useState(false);

  async function cargar() {
    try {
      setError(null);
      const respuesta = await api.articulo(id);
      setArticulo(respuesta.data);
    } catch (e) {
      setError(e.message);
    } finally {
      setCargando(false);
    }
  }

  async function revisarFavorito() {
    if (!token) {
      setEsFavorito(false);
      return;
    }
    try {
      const lista = await api.favoritos(token);
      setEsFavorito(lista.data.some((a) => a.id === id));
    } catch (e) {
      setEsFavorito(false);
    }
  }

  // Se vuelve a consultar cada vez que la pantalla aparece (por ejemplo, después de iniciar sesión).
  useFocusEffect(
    useCallback(() => {
      cargar();
      revisarFavorito();
    }, [id, token])
  );

  async function alternarFavorito() {
    if (!token) {
      navigation.navigate('Login');
      return;
    }
    setOcupado(true);
    try {
      if (esFavorito) {
        await api.quitarFavorito(token, id);
      } else {
        await api.agregarFavorito(token, id);
      }
      setEsFavorito(!esFavorito);
    } catch (e) {
      setError(e.message);
    } finally {
      setOcupado(false);
    }
  }

  if (cargando) {
    return (
      <View style={estilos.centro}>
        <ActivityIndicator color={colores.primario} />
      </View>
    );
  }
  if (error && !articulo) return <Estado mensaje={`No se pudo cargar: ${error}`} onReintentar={cargar} />;
  if (!articulo) return <Estado mensaje="Este artículo no está disponible." />;

  const parrafos = (articulo.body || '')
    .split(/\n\s*\n/)
    .map((p) => p.trim())
    .filter(Boolean);
  const autores = Array.isArray(articulo.authors) ? articulo.authors.join(', ') : '';
  const portada = urlAbsoluta(articulo.portada_url);

  return (
    <ScrollView contentContainerStyle={{ padding: 16, paddingBottom: 40 }}>
      {portada && !portadaFallo ? (
        <Image
          source={{ uri: portada }}
          onError={() => setPortadaFallo(true)}
          style={{ width: '100%', height: 320, borderRadius: 10, backgroundColor: colores.borde, marginBottom: 16 }}
          resizeMode="contain"
        />
      ) : null}

      <Text style={[estilos.titulo, { fontSize: 22, lineHeight: 28 }]}>{articulo.title}</Text>
      {autores ? <Text style={[estilos.texto, { marginTop: 6 }]}>{autores}</Text> : null}
      <Text style={estilos.subtexto}>
        {[articulo.section?.name, articulo.journal_name].filter(Boolean).join('  ·  ')}
      </Text>

      {articulo.abstract ? (
        <View style={{ marginTop: 18 }}>
          <Text style={estilos.seccion}>Resumen</Text>
          <Text style={estilos.texto}>{articulo.abstract}</Text>
        </View>
      ) : null}

      {articulo.pdf_url ? (
        <Pressable style={estilos.boton} onPress={() => Linking.openURL(urlAbsoluta(articulo.pdf_url))}>
          <Text style={estilos.botonTexto}>Abrir PDF</Text>
        </Pressable>
      ) : null}

      <Pressable
        style={estilos.botonSecundario}
        onPress={alternarFavorito}
        disabled={ocupado}
      >
        <Text style={estilos.botonSecundarioTexto}>
          {!token ? 'Inicia sesión para guardar en favoritos' : esFavorito ? 'Quitar de favoritos' : 'Guardar en favoritos'}
        </Text>
      </Pressable>

      {parrafos.length > 0 ? (
        <View style={{ marginTop: 22, gap: 12 }}>
          <Text style={estilos.seccion}>Texto del artículo</Text>
          {parrafos.map((p, i) => (
            <Text key={i} style={[estilos.texto, { fontSize: 16, lineHeight: 26 }]}>
              {p}
            </Text>
          ))}
        </View>
      ) : null}
    </ScrollView>
  );
}
