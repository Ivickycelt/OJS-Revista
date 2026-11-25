# Manual técnico — Revista Horizontes

## 1. Arquitectura

| Componente | Tecnología | Carpeta | Función |
|---|---|---|---|
| Editor de revistas | OJS 3.5 (PKP) | XAMPP, http://localhost/ojs | Recibe envíos, revisa, publica. Expone el catálogo por OAI-PMH. |
| Backend y API | Laravel 12, Sanctum | `backend/` | Lee el OAI de OJS, guarda revistas, números y artículos; expone la API REST. |
| Portal web | Blade + JavaScript (SPA) | `backend/resources/views/portal.blade.php` | Lectura pública de revistas y artículos. |
| App móvil | Expo (React Native) | `app-movil/` | Lectura en Android, búsqueda, favoritos. |
| Tema OJS | Plantilla propia | `ojs-theme/horizontes/` | Identidad visual de la revista en OJS. |

Flujo de datos: OJS → (OAI-PMH, comando `ojs:sincronizar`) → base de datos de Laravel → API → portal y app móvil.

## 2. Requisitos

- PHP 8.2 o superior, Composer, MySQL (XAMPP).
- Node.js LTS para la app móvil.
- Expo Go en el celular para probar la app.

## 3. Configuración

Archivo `backend/.env` (no se sube a GitHub). Variables importantes:

| Variable | Uso |
|---|---|
| `APP_DEBUG` | `false` en uso normal; `true` solo para depurar. |
| `DEMO_ADMIN_PASSWORD` | Contraseña del usuario admin de demostración. |
| `DEMO_LECTOR_PASSWORD` | Contraseña del usuario lector de demostración. |

Si no defines las variables DEMO, el seeder genera contraseñas aleatorias y las muestra en consola una sola vez.

Para cambiar la contraseña de un usuario existente, desde `backend` usa `php artisan tinker` y `Hash::make(...)`. Usar `update()` sin `Hash::make` guarda la contraseña sin encriptar.

## 4. Comandos principales

| Comando | Para qué |
|---|---|
| `php artisan serve` | Levanta el portal y la API en http://127.0.0.1:8000 |
| `php artisan serve --host=0.0.0.0 --port=8000` | Igual, pero accesible desde el celular en la misma red |
| `php artisan ojs:sincronizar` | Trae revistas, números y artículos desde OJS |
| `php artisan db:seed` | Carga datos de ejemplo y usuarios de demostración |

No uses `migrate:fresh` con datos reales: borra la base de datos.

## 5. API REST (prefijo `/api`)

Públicos:
- `GET /revistas`, `GET /revistas/{slug}`, `GET /revistas/{slug}/secciones`
- `GET /revistas/{slug}/numeros`, `GET /revistas/{slug}/numeros/{id}`
- `GET /articles?search=...&journal=...&section=...&issue=...`, `GET /articles/{id}`
- `GET /issues`, `GET /issues/{id}`, `GET /sections`

Autenticación:
- `POST /login` (máximo 6 intentos por minuto), `POST /register`
- Con token Sanctum: `GET /me`, `POST /logout`

Con sesión:
- `GET /favorites`, `POST /favorites/{article}`, `DELETE /favorites/{article}`

Solo administradores: `POST /articles`, `PUT /articles/{article}`, `DELETE /articles/{article}`.

## 6. Sincronización con OJS

- El comando lee `http://localhost/ojs/index.php/horizontes/es/oai` con `verb=ListRecords` y `metadataPrefix=oai_dc`.
- La sección se asigna con el `setSpec` de OJS: `EDIT` → Editorial, `COM` → Comunicación breve, `ORIG` → Artículos originales, `REV` → Artículo de revisión, `TES` → Tesis de egresados.
- Las portadas se toman de `backend/public/portadas/` y los PDF de `backend/public/pdf/`. La URL de la portada se deriva de la del PDF.

## 7. App móvil

- Configuración de la dirección del backend en `app-movil/src/config.js` (`BASE_URL`).
- Las rutas de PDF que llegan de la API se convierten a la dirección de `BASE_URL` para que el celular las abra.
- El token de sesión se guarda con `expo-secure-store`.
- Para generar un APK instalable: EAS Build (`npx eas build -p android`).

## 8. Seguridad

- Contraseñas de demostración fuera del código (en `.env`).
- `APP_DEBUG=false` en el ejemplo de configuración.
- Límite de intentos en login y registro.
- Pendiente antes de publicar: certificado HTTPS en el servidor final y configuración de correo (SMTP) en OJS.
