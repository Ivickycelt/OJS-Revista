# Horizontes — app Android (Expo)

App móvil para leer las revistas de la UICM desde el backend Laravel.

Funciones:
- Ver revistas, números, artículos agrupados por sección.
- Leer el resumen, el texto y abrir el PDF.
- Buscar artículos.
- Iniciar sesión y guardar favoritos.

## Antes de empezar

1. Instala **Node.js LTS** (https://nodejs.org).
2. En el celular Android instala la app **Expo Go** desde Play Store.
3. Tu PC y el celular deben estar en **la misma red Wi-Fi**.

## Preparar el backend (en tu PC)

El celular no puede ver `127.0.0.1`. Hay que levantar Laravel escuchando en toda la red:

```
cd C:\proyectos\OJS-Revista\backend
php artisan serve --host=0.0.0.0 --port=8000
```

Si Windows pregunta por el firewall, permite el acceso en redes privadas.

Busca la IP de tu PC con `ipconfig` (campo "Dirección IPv4"), por ejemplo `192.168.1.50`.

## Configurar la app

Abre `src/config.js` y cambia la IP:

```js
export const BASE_URL = 'http://192.168.1.50:8000';
```

## Instalar y correr

Desde la carpeta `app-movil`:

```
npm install
npx expo install --fix
npx expo start
```

Aparecerá un código QR en la terminal. Ábrelo con Expo Go en tu celular.

## Notas

- Las contraseñas de prueba no están en la app. Cada usuario inicia sesión con su correo y contraseña del backend.
- Si cambias de red Wi-Fi, cambia también la IP en `src/config.js`.
- Para generar un APK instalable más adelante se usa EAS Build (`npx eas build -p android`).
