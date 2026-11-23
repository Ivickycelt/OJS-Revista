import { StyleSheet } from 'react-native';

// Colores tomados del estilo del portal (café dorado sobre fondo crema).
export const colores = {
  primario: '#8a5a00',
  fondo: '#faf7f2',
  tarjeta: '#ffffff',
  texto: '#1f1a14',
  subtexto: '#6b6259',
  borde: '#e7e0d4',
  error: '#b3261e',
};

export const estilos = StyleSheet.create({
  centro: { flex: 1, alignItems: 'center', justifyContent: 'center', padding: 24, backgroundColor: colores.fondo },
  lista: { padding: 16, gap: 12, backgroundColor: colores.fondo },
  tarjeta: {
    backgroundColor: colores.tarjeta,
    borderRadius: 12,
    padding: 16,
    borderWidth: 1,
    borderColor: colores.borde,
  },
  titulo: { fontSize: 17, fontWeight: '700', color: colores.texto, marginBottom: 4 },
  texto: { fontSize: 15, color: colores.texto, lineHeight: 22 },
  subtexto: { fontSize: 13, color: colores.subtexto, marginTop: 4 },
  boton: {
    backgroundColor: colores.primario,
    borderRadius: 10,
    paddingVertical: 12,
    paddingHorizontal: 18,
    alignItems: 'center',
    marginTop: 12,
  },
  botonTexto: { color: '#fff', fontWeight: '700', fontSize: 15 },
  botonSecundario: {
    borderColor: colores.primario,
    borderWidth: 1,
    borderRadius: 10,
    paddingVertical: 12,
    paddingHorizontal: 18,
    alignItems: 'center',
    marginTop: 10,
  },
  botonSecundarioTexto: { color: colores.primario, fontWeight: '700', fontSize: 15 },
  input: {
    backgroundColor: colores.tarjeta,
    borderWidth: 1,
    borderColor: colores.borde,
    borderRadius: 10,
    paddingHorizontal: 14,
    paddingVertical: 12,
    fontSize: 16,
    color: colores.texto,
    marginTop: 8,
  },
  error: { color: colores.error, marginTop: 10, fontSize: 14 },
  seccion: {
    fontSize: 13,
    fontWeight: '700',
    color: colores.primario,
    textTransform: 'uppercase',
    paddingTop: 16,
    paddingBottom: 6,
    backgroundColor: colores.fondo,
  },
});
