import React, { useEffect, useRef, useState } from 'react';
import { ActivityIndicator, BackHandler, Platform, StatusBar, View } from 'react-native';
import { WebView } from 'react-native-webview';
import { BASE_URL } from './src/config';
import { colores } from './src/theme';

// SanColFree: la app abre el portal dentro de la app.
export default function App() {
  const webRef = useRef(null);
  const [puedeRegresar, setPuedeRegresar] = useState(false);

  // El botón Atrás de Android regresa una página dentro del portal antes de cerrar la app.
  useEffect(() => {
    const suscripcion = BackHandler.addEventListener('hardwareBackPress', () => {
      if (puedeRegresar && webRef.current) {
        webRef.current.goBack();
        return true;
      }
      return false;
    });
    return () => suscripcion.remove();
  }, [puedeRegresar]);

  return (
    <View
      style={{
        flex: 1,
        backgroundColor: colores.fondo,
        paddingTop: Platform.OS === 'android' ? StatusBar.currentHeight : 0,
      }}
    >
      <StatusBar barStyle="dark-content" backgroundColor={colores.fondo} />
      <WebView
        ref={webRef}
        source={{ uri: BASE_URL }}
        onNavigationStateChange={(estado) => setPuedeRegresar(estado.canGoBack)}
        javaScriptEnabled
        domStorageEnabled
        startInLoadingState
        renderLoading={() => (
          <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center', backgroundColor: colores.fondo }}>
            <ActivityIndicator color={colores.primario} />
          </View>
        )}
        style={{ flex: 1, backgroundColor: colores.fondo }}
      />
    </View>
  );
}
