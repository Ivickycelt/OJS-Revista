import React from 'react';
import { StatusBar } from 'expo-status-bar';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { AuthProvider } from './src/auth';
import { colores } from './src/theme';
import RevistasScreen from './src/screens/RevistasScreen';
import NumerosScreen from './src/screens/NumerosScreen';
import NumeroScreen from './src/screens/NumeroScreen';
import ArticuloScreen from './src/screens/ArticuloScreen';
import BuscarScreen from './src/screens/BuscarScreen';
import LoginScreen from './src/screens/LoginScreen';
import FavoritosScreen from './src/screens/FavoritosScreen';

const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <AuthProvider>
      <NavigationContainer>
        <StatusBar style="dark" />
        <Stack.Navigator
          screenOptions={{
            headerTintColor: colores.primarioOscuro,
            headerStyle: { backgroundColor: '#ffffff' },
            headerTitleStyle: { fontWeight: '800', color: colores.primarioOscuro },
            headerShadowVisible: false,
            contentStyle: { backgroundColor: colores.fondo },
          }}
        >
          <Stack.Screen name="Revistas" component={RevistasScreen} options={{ title: 'SanColFr' }} />
          <Stack.Screen name="Numeros" component={NumerosScreen} options={({ route }) => ({ title: route.params.nombre })} />
          <Stack.Screen name="Numero" component={NumeroScreen} options={({ route }) => ({ title: route.params.titulo })} />
          <Stack.Screen name="Articulo" component={ArticuloScreen} options={{ title: 'Artículo' }} />
          <Stack.Screen name="Buscar" component={BuscarScreen} options={{ title: 'Buscar' }} />
          <Stack.Screen name="Login" component={LoginScreen} options={{ title: 'Iniciar sesión' }} />
          <Stack.Screen name="Favoritos" component={FavoritosScreen} options={{ title: 'Mis favoritos' }} />
        </Stack.Navigator>
      </NavigationContainer>
    </AuthProvider>
  );
}
