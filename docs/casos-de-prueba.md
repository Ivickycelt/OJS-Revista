# Casos de prueba — Revista Horizontes

Fecha de la última revisión: 23 de noviembre de 2026.
Estado: **OK** = probado y funciona · **Pendiente** = falta probarlo.

| # | Caso | Pasos | Resultado esperado | Estado |
|---|---|---|---|---|
| 1 | Listar revistas | Abrir el portal `/revistas/horizontes` | Se muestra la revista y sus artículos | OK |
| 2 | Artículo nuevo en el portal | Publicar en OJS, ejecutar `ojs:sincronizar`, recargar | El artículo aparece en su sección | OK |
| 3 | Página de artículo | Abrir `/revistas/horizontes/articulos/2` | Título, sección, resumen, palabras clave, texto y PDF | OK |
| 4 | Portada en la lista | Ver la lista de artículos | Cada artículo muestra su primera página | OK |
| 5 | OAI-PMH por sección | Consultar `ListIdentifiers` con `set=horizontes:COM` | El artículo 2 aparece con su sección | OK |
| 6 | Login de administrador (API) | `POST /api/login` con las credenciales de admin | Respuesta 200 con token | OK |
| 7 | Login de lector (API) | `POST /api/login` con las credenciales de lector | Respuesta 200 con token | OK |
| 8 | Login con contraseña incorrecta | `POST /api/login` con clave mala | Respuesta 401 con mensaje | Pendiente |
| 9 | Búsqueda de artículos | `GET /api/articles?search=ética` | Devuelve el artículo 2 | Pendiente |
| 10 | Artículo inexistente | Abrir `/revistas/horizontes/articulos/999` | Mensaje de "no encontrado" sin error | Pendiente |
| 11 | Portal en celular | Abrir el portal con el ancho de un teléfono | Sin scroll horizontal; texto legible | Pendiente |
| 12 | App: listar revistas, números y artículos | Abrir la app con Expo Go | Navegación completa sin errores | Pendiente |
| 13 | App: abrir PDF | Entrar a un artículo y pulsar *Abrir PDF* | Se abre el PDF en el navegador del celular | Pendiente |
| 14 | App: favoritos | Iniciar sesión, guardar y quitar un favorito | El favorito aparece y desaparece en *Mis favoritos* | Pendiente |
| 15 | Pie de página | Revisar que el pie muestre SanColFr | Muestra SanColFr | Pendiente (el pie cambió) |
