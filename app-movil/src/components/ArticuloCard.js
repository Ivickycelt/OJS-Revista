import React from 'react';
import { Pressable, Text } from 'react-native';
import { estilos } from '../theme';

// Tarjeta de un artículo: título, autores y página inicial.
export default function ArticuloCard({ articulo, onPress }) {
  const autores = Array.isArray(articulo.authors) ? articulo.authors.join(', ') : '';
  return (
    <Pressable style={estilos.tarjeta} onPress={onPress}>
      <Text style={estilos.titulo}>{articulo.title}</Text>
      {autores ? <Text style={estilos.texto}>{autores}</Text> : null}
      <Text style={estilos.subtexto}>
        {articulo.section?.name ? `${articulo.section.name}` : ''}
        {articulo.start_page ? `  ·  Pág. ${articulo.start_page}` : ''}
      </Text>
    </Pressable>
  );
}
