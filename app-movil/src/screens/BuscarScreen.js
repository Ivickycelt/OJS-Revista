import React, { useState } from 'react';
import { ActivityIndicator, FlatList, Text, TextInput, View } from 'react-native';
import { api } from '../api';
import ArticuloCard from '../components/ArticuloCard';
import { colores, estilos } from '../theme';

export default function BuscarScreen({ navigation }) {
  const [texto, setTexto] = useState('');
  const [resultados, setResultados] = useState([]);
  const [buscando, setBuscando] = useState(false);
  const [error, setError] = useState(null);
  const [buscado, setBuscado] = useState(false);

  async function buscar() {
    const termino = texto.trim();
    if (!termino) return;
    setBuscando(true);
    setError(null);
    try {
      const respuesta = await api.buscar(termino);
      setResultados(respuesta.data);
    } catch (e) {
      setError(e.message);
    } finally {
      setBuscando(false);
      setBuscado(true);
    }
  }

  return (
    <View style={{ flex: 1, padding: 16 }}>
      <TextInput
        style={estilos.input}
        placeholder="Título, autor o palabra clave"
        value={texto}
        onChangeText={setTexto}
        onSubmitEditing={buscar}
        returnKeyType="search"
        autoCorrect={false}
      />
      {buscando ? <ActivityIndicator style={{ marginTop: 16 }} color={colores.primario} /> : null}
      {error ? <Text style={estilos.error}>{error}</Text> : null}
      {buscado && !buscando && resultados.length === 0 && !error ? (
        <Text style={[estilos.texto, { marginTop: 16, textAlign: 'center' }]}>No encontramos artículos con esa búsqueda.</Text>
      ) : null}
      <FlatList
        style={{ marginTop: 12 }}
        data={resultados}
        keyExtractor={(a) => String(a.id)}
        contentContainerStyle={{ gap: 12, paddingBottom: 24 }}
        renderItem={({ item }) => (
          <ArticuloCard articulo={item} onPress={() => navigation.navigate('Articulo', { id: item.id })} />
        )}
      />
    </View>
  );
}
