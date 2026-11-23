import React, { useEffect, useState } from 'react';
import { ActivityIndicator, SectionList, Text, View } from 'react-native';
import { api } from '../api';
import ArticuloCard from '../components/ArticuloCard';
import Estado from '../components/Estado';
import { colores, estilos } from '../theme';

// Agrupa los artículos por sección (Editorial, Artículos originales, etc.)
function agrupar(articulos) {
  const grupos = {};
  articulos.forEach((a) => {
    const nombre = a.section?.name || 'Otros';
    if (!grupos[nombre]) grupos[nombre] = [];
    grupos[nombre].push(a);
  });
  return Object.keys(grupos).map((nombre) => ({ title: nombre, data: grupos[nombre] }));
}

export default function NumeroScreen({ route, navigation }) {
  const { slug, id } = route.params;
  const [secciones, setSecciones] = useState([]);
  const [cargando, setCargando] = useState(true);
  const [error, setError] = useState(null);

  async function cargar() {
    try {
      setError(null);
      const respuesta = await api.numero(slug, id);
      setSecciones(agrupar(respuesta.data.articles || []));
    } catch (e) {
      setError(e.message);
    } finally {
      setCargando(false);
    }
  }

  useEffect(() => {
    cargar();
  }, [slug, id]);

  if (cargando) {
    return (
      <View style={estilos.centro}>
        <ActivityIndicator color={colores.primario} />
      </View>
    );
  }
  if (error) return <Estado mensaje={`No se pudo cargar: ${error}`} onReintentar={cargar} />;
  if (secciones.length === 0) return <Estado mensaje="Este número no tiene artículos todavía." />;

  return (
    <SectionList
      sections={secciones}
      keyExtractor={(a) => String(a.id)}
      contentContainerStyle={{ paddingHorizontal: 16, paddingBottom: 24, gap: 12 }}
      renderSectionHeader={({ section }) => <Text style={estilos.seccion}>{section.title}</Text>}
      renderItem={({ item }) => (
        <ArticuloCard articulo={item} onPress={() => navigation.navigate('Articulo', { id: item.id })} />
      )}
    />
  );
}
