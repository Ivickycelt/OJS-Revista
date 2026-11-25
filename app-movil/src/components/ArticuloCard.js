import React, { useState } from 'react';
import { Image, Pressable, Text, View } from 'react-native';
import { urlAbsoluta } from '../config';
import { estilos } from '../theme';

// Tarjeta de un artículo con portada, sección, título y autores (estilo del portal).
export default function ArticuloCard({ articulo, onPress }) {
  const [portadaFallo, setPortadaFallo] = useState(false);
  const autores = Array.isArray(articulo.authors) ? articulo.authors.join(', ') : '';
  const portada = urlAbsoluta(articulo.portada_url);

  return (
    <Pressable style={[estilos.tarjeta, { padding: 0, overflow: 'hidden' }]} onPress={onPress}>
      {portada && !portadaFallo ? (
        <Image
          source={{ uri: portada }}
          onError={() => setPortadaFallo(true)}
          style={{ width: '100%', height: 200, backgroundColor: '#f4f4f4' }}
          resizeMode="cover"
        />
      ) : null}
      <View style={{ padding: 16, gap: 8 }}>
        {articulo.section?.name ? (
          <View style={estilos.chip}>
            <Text style={estilos.chipTexto}>{articulo.section.name}</Text>
          </View>
        ) : null}
        <Text style={estilos.titulo}>{articulo.title}</Text>
        {autores ? <Text style={estilos.texto}>{autores}</Text> : null}
        {articulo.start_page ? <Text style={estilos.subtexto}>Pág. {articulo.start_page}</Text> : null}
      </View>
    </Pressable>
  );
}
