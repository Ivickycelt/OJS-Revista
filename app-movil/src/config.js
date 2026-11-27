// Dirección del backend Laravel.
// Celular real en tu Wi-Fi: la IP de tu PC (ipconfig, Dirección IPv4).
// Emulador de Android Studio: cambia a http://10.0.2.2:8000
export const BASE_URL = 'http://192.168.100.5:8000';
export const API_URL = `${BASE_URL}/api`;

// La API devuelve rutas como "/pdf/archivo.pdf" o URLs con localhost.
// Esta función las convierte en una dirección que el celular sí puede abrir.
export function urlAbsoluta(ruta) {
  if (!ruta) return null;
  if (ruta.startsWith('http')) {
    return ruta.replace(/^https?:\/\/[^/]+/, BASE_URL);
  }
  return `${BASE_URL}${ruta}`;
}
