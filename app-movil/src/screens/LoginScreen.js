import React, { useState } from 'react';
import { ActivityIndicator, Pressable, Text, TextInput, View } from 'react-native';
import { useAuth } from '../auth';
import { colores, estilos } from '../theme';

export default function LoginScreen({ navigation }) {
  const { iniciarSesion } = useAuth();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [enviando, setEnviando] = useState(false);
  const [error, setError] = useState(null);

  async function entrar() {
    if (!email.trim() || !password) {
      setError('Escribe tu correo y tu contraseña.');
      return;
    }
    setEnviando(true);
    setError(null);
    try {
      await iniciarSesion(email.trim(), password);
      navigation.goBack();
    } catch (e) {
      setError(e.message || 'No se pudo iniciar sesión.');
    } finally {
      setEnviando(false);
    }
  }

  return (
    <View style={{ flex: 1, padding: 20, justifyContent: 'center' }}>
      <Text style={[estilos.titulo, { fontSize: 22, marginBottom: 6 }]}>Bienvenido</Text>
      <Text style={estilos.texto}>Inicia sesión para guardar artículos en tus favoritos.</Text>

      <TextInput
        style={estilos.input}
        placeholder="Correo electrónico"
        value={email}
        onChangeText={setEmail}
        autoCapitalize="none"
        keyboardType="email-address"
        autoComplete="email"
      />
      <TextInput
        style={estilos.input}
        placeholder="Contraseña"
        value={password}
        onChangeText={setPassword}
        secureTextEntry
        autoCapitalize="none"
        onSubmitEditing={entrar}
      />

      {error ? <Text style={estilos.error}>{error}</Text> : null}

      <Pressable style={estilos.boton} onPress={entrar} disabled={enviando}>
        {enviando ? <ActivityIndicator color="#fff" /> : <Text style={estilos.botonTexto}>Entrar</Text>}
      </Pressable>
    </View>
  );
}
