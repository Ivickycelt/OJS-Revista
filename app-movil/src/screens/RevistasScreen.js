import React, { useEffect, useLayoutEffect, useState } from 'react';
import { ActivityIndicator, FlatList, Pressable, RefreshControl, Text, View } from 'react-native';
import { api } from '../api';
import { useAuth } from '../auth';
import Estado from '../components/Estado';
import { colores, estilos } from '../theme';

export default function RevistasScreen({ navigation }) {
  const { usuario } = useAuth();
  const [revistas, setRevistas] = useState([]);
  const [cargando, setCargando] = useState(true);
  const [refrescando, setRefrescando] = useState(false);
  const [error, setError] = useState(null);

  useLayoutEffect(() => {
    navigation.setOptions({
      headerRight: () => (
        <View style={{ flexDirection: 'row', gap: 16 }}>
          <Pressable onPress={() => navigation.navigate('Buscar')}>
            <Text style={{ color: colores.primario, fontWeight: '600' }}>Buscar</Text>
          </Pressable>
          <Pressable onPress={() => navigation.navigate(usuario ? 'Favoritos' : 'Login')}>
            <Text style={{ color: colores.primario, fontWeight: '600' }}>{usuario ? 'Favoritos' : 'Entrar'}</Text>
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
      contentContainerStyle={estilos.lista}
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
          style={estilos.tarjeta}
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
