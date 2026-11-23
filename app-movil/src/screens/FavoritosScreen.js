import React, { useCallback, useState } from 'react';
import { ActivityIndicator, FlatList, Pressable, Text, View } from 'react-native';
import { useFocusEffect } from '@react-navigation/native';
import { api } from '../api';
import { useAuth } from '../auth';
import ArticuloCard from '../components/ArticuloCard';
import Estado from '../components/Estado';
import { colores, estilos } from '../theme';

export default function FavoritosScreen({ navigation }) {
  const { token, cerrarSesion } = useAuth();
  const [favoritos, setFavoritos] = useState([]);
  const [cargando, setCargando] = useState(false);
  const [error, setError] = useState(null);

  async function cargar() {
    if (!token) return;
    setCargando(true);
    setError(null);
    try {
      const respuesta = await api.favoritos(token);
      setFavoritos(respuesta.data);
    } catch (e) {
      setError(e.message);
    } finally {
      setCargando(false);
    }
  }

  useFocusEffect(
    useCallback(() => {
      cargar();
    }, [token])
  );

  if (!token) {
    return (
      <View style={estilos.centro}>
        <Text style={[estilos.texto, { textAlign: 'center' }]}>Inicia sesión para ver tus artículos favoritos.</Text>
        <Pressable style={estilos.boton} onPress={() => navigation.navigate('Login')}>
          <Text style={estilos.botonTexto}>Iniciar sesión</Text>
        </Pressable>
      </View>
    );
  }
  if (cargando) {
    return (
      <View style={estilos.centro}>
        <ActivityIndicator color={colores.primario} />
      </View>
    );
  }
  if (error) return <Estado mensaje={error} onReintentar={cargar} />;

  return (
    <FlatList
      data={favoritos}
      keyExtractor={(a) => String(a.id)}
      contentContainerStyle={estilos.lista}
      ListEmptyComponent={
        <Text style={[estilos.texto, { textAlign: 'center', marginTop: 40 }]}>
          Todavía no tienes favoritos. Guárdalos desde un artículo.
        </Text>
      }
      ListFooterComponent={
        <Pressable
          style={estilos.botonSecundario}
          onPress={async () => {
            await cerrarSesion();
            navigation.goBack();
          }}
        >
          <Text style={estilos.botonSecundarioTexto}>Cerrar sesión</Text>
        </Pressable>
      }
      renderItem={({ item }) => (
        <ArticuloCard articulo={item} onPress={() => navigation.navigate('Articulo', { id: item.id })} />
      )}
    />
  );
}
