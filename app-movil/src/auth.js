import React, { createContext, useContext, useEffect, useState } from 'react';
import * as SecureStore from 'expo-secure-store';
import { api } from './api';

const CLAVE_TOKEN = 'hz_token';
const CLAVE_USUARIO = 'hz_usuario';

const AuthContext = createContext(null);

export function AuthProvider({ children }) {
  const [token, setToken] = useState(null);
  const [usuario, setUsuario] = useState(null);
  const [cargando, setCargando] = useState(true);

  useEffect(() => {
    (async () => {
      try {
        const t = await SecureStore.getItemAsync(CLAVE_TOKEN);
        const u = await SecureStore.getItemAsync(CLAVE_USUARIO);
        if (t) {
          setToken(t);
          setUsuario(u ? JSON.parse(u) : null);
        }
      } catch (e) {
        // Si no se puede leer el almacenamiento, la app sigue sin sesión.
      }
      setCargando(false);
    })();
  }, []);

  async function iniciarSesion(email, password) {
    const datos = await api.login(email, password);
    await SecureStore.setItemAsync(CLAVE_TOKEN, datos.token);
    await SecureStore.setItemAsync(CLAVE_USUARIO, JSON.stringify(datos.user));
    setToken(datos.token);
    setUsuario(datos.user);
  }

  async function cerrarSesion() {
    try {
      if (token) await api.logout(token);
    } catch (e) {
      // Aunque falle el servidor, borramos la sesión local.
    }
    await SecureStore.deleteItemAsync(CLAVE_TOKEN);
    await SecureStore.deleteItemAsync(CLAVE_USUARIO);
    setToken(null);
    setUsuario(null);
  }

  return (
    <AuthContext.Provider
      value={{ token, usuario, cargando, iniciarSesion, cerrarSesion }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export const useAuth = () => useContext(AuthContext);
