import React from 'react';
import { Pressable, Text, View } from 'react-native';
import { colores, estilos } from '../theme';

// Muestra un mensaje (cargando, error o vacío) con botón opcional para reintentar.
export default function Estado({ mensaje, onReintentar }) {
  return (
    <View style={estilos.centro}>
      <Text style={[estilos.texto, { textAlign: 'center' }]}>{mensaje}</Text>
      {onReintentar ? (
        <Pressable style={estilos.boton} onPress={onReintentar}>
          <Text style={estilos.botonTexto}>Reintentar</Text>
        </Pressable>
      ) : null}
    </View>
  );
}
