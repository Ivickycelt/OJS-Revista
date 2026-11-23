import { API_URL } from './config';

async function peticion(ruta, { metodo = 'GET', token, cuerpo } = {}) {
  const cabeceras = { Accept: 'application/json' };
  if (cuerpo) cabeceras['Content-Type'] = 'application/json';
  if (token) cabeceras.Authorization = `Bearer ${token}`;

  const respuesta = await fetch(`${API_URL}${ruta}`, {
    method: metodo,
    headers: cabeceras,
    body: cuerpo ? JSON.stringify(cuerpo) : undefined,
  });

  let datos = null;
  try {
    datos = await respuesta.json();
  } catch (e) {
    datos = null;
  }

  if (!respuesta.ok) {
    if (respuesta.status === 401 && token) {
      throw new Error('Tu sesión venció. Vuelve a iniciar sesión.');
    }
    throw new Error(datos?.message || `Error ${respuesta.status}`);
  }
  return datos;
}

export const api = {
  revistas: () => peticion('/revistas'),
  revista: (slug) => peticion(`/revistas/${slug}`),
  numeros: (slug) => peticion(`/revistas/${slug}/numeros`),
  numero: (slug, id) => peticion(`/revistas/${slug}/numeros/${id}`),
  articulo: (id) => peticion(`/articles/${id}`),
  buscar: (texto) => peticion(`/articles?search=${encodeURIComponent(texto)}`),
  login: (email, password) =>
    peticion('/login', { metodo: 'POST', cuerpo: { email, password } }),
  logout: (token) => peticion('/logout', { metodo: 'POST', token }),
  favoritos: (token) => peticion('/favorites', { token }),
  agregarFavorito: (token, id) =>
    peticion(`/favorites/${id}`, { metodo: 'POST', token }),
  quitarFavorito: (token, id) =>
    peticion(`/favorites/${id}`, { metodo: 'DELETE', token }),
};
