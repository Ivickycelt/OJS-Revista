import React, { useEffect, useState } from 'react';
import { ActivityIndicator, FlatList, Pressable, Text, View } from 'react-native';
import { api } from '../api';
import Estado from '../components/Estado';
import { colores, estilos } from '../theme';

export default function NumerosScreen({ route, navigation }) {
  const { slug } = route.params;
  const [numeros, setNumeros] = useState([]);
  const [cargando, setCargando] = useState(true);
  const [error, setError] = useState(null);

  async function cargar() {
    try {
      setError(null);
      const respuesta = await api.numeros(slug);
      setNumeros(respuesta.data);
    } catch (e) {
      setError(e.message);
    } finally {
      setCargando(false);
    }
  }

  useEffect(() => {
    cargar();
  }, [slug]);

  if (cargando) {
    return (
      <View style={estilos.centro}>
        <ActivityIndicator color={colores.primario} />
      </View>
    );
  }
  if (error) return <Estado mensaje={`No se pudo cargar: ${error}`} onReintentar={cargar} />;
  if (numeros.length === 0) return <Estado mensaje="Esta revista todavía no tiene números publicados." />;

  return (
    <FlatList
      data={numeros}
      keyExtractor={(n) => String(n.id)}
      contentContainerStyle={estilos.lista}
      renderItem={({ item }) => {
        const titulo = item.title || `Vol. ${item.volume}, Núm. ${item.number} (${item.year})`;
        return (
          <Pressable
            style={estilos.tarjeta}
            onPress={() => navigation.navigate('Numero', { slug, id: item.id, titulo })}
          >
            <Text style={estilos.titulo}>{titulo}</Text>
            {item.published_at ? <Text style={estilos.subtexto}>Publicado el {item.published_at}</Text> : null}
          </Pressable>
        );
      }}
    />
  );
}
