import React, { useEffect, useLayoutEffect, useState } from 'react';
import { ActivityIndicator, FlatList, Pressable, RefreshControl, Text, View } from 'react-native';
import { api } from '../api';
import { useAuth } from '../auth';
import Estado from '../components/Estado';
import { colores, estilos } from '../theme';

// Encabezado tipo portal: bloque verde con insignia dorada.
function Encabezado() {
  return (
    <View style={estilos.hero}>
      <View style={estilos.insignia}>
        <Text style={estilos.insigniaTexto}>Acceso abierto</Text>
      </View>
      <Text style={estilos.heroTitulo}>Revistas</Text>
      <Text style={estilos.heroTexto}>Plataforma de revistas digitales de acceso abierto</Text>
    </View>
  );
}

const botonEncabezado = {
  borderWidth: 2,
  borderColor: colores.primario,
  borderRadius: 8,
  paddingHorizontal: 10,
  paddingVertical: 4,
};

export default function RevistasScreen({ navigation }) {
  const { usuario } = useAuth();
  const [revistas, setRevistas] = useState([]);
  const [cargando, setCargando] = useState(true);
  const [refrescando, setRefrescando] = useState(false);
  const [error, setError] = useState(null);

  useLayoutEffect(() => {
    navigation.setOptions({
      headerRight: () => (
        <View style={{ flexDirection: 'row', gap: 8 }}>
          <Pressable style={botonEncabezado} onPress={() => navigation.navigate('Buscar')}>
            <Text style={{ color: colores.primario, fontWeight: '700' }}>Buscar</Text>
          </Pressable>
          <Pressable
            style={[botonEncabezado, { backgroundColor: colores.primario }]}
            onPress={() => navigation.navigate(usuario ? 'Favoritos' : 'Login')}
          >
            <Text style={{ color: '#ffffff', fontWeight: '700' }}>{usuario ? 'Favoritos' : 'Entrar'}</Text>
          </Pressable>
        </View>
      ),
    });
  }, [navigation, usuario]);

  async function cargar() {
    try {
      setError(null);
      const respuesta = await api.revistas();
      setRevistas(respuesta.data);
    } catch (e) {
      setError(e.message);
    } finally {
      setCargando(false);
      setRefrescando(false);
    }
  }

  useEffect(() => {
    cargar();
  }, []);

  if (cargando) {
    return (
      <View style={estilos.centro}>
        <ActivityIndicator color={colores.primario} />
      </View>
    );
  }
  if (error) {
    return <Estado mensaje={`No se pudo cargar: ${error}`} onReintentar={cargar} />;
  }

  return (
    <FlatList
      data={revistas}
      keyExtractor={(r) => String(r.id)}
      contentContainerStyle={{ backgroundColor: colores.fondo, paddingBottom: 24, gap: 14 }}
      ListHeaderComponent={Encabezado}
      refreshControl={
        <RefreshControl
          refreshing={refrescando}
          onRefresh={() => {
            setRefrescando(true);
            cargar();
          }}
        />
      }
      renderItem={({ item }) => (
        <Pressable
          style={[estilos.tarjeta, { marginHorizontal: 16 }]}
          onPress={() => navigation.navigate('Numeros', { slug: item.slug, nombre: item.name })}
        >
          <Text style={estilos.titulo}>{item.name}</Text>
          {item.description ? <Text style={estilos.texto}>{item.description}</Text> : null}
          {item.issn ? <Text style={estilos.subtexto}>ISSN {item.issn}</Text> : null}
        </Pressable>
      )}
    />
  );
}
