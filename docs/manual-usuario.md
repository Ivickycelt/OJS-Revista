# Manual de usuario — Revista Horizontes (UICM)

Este manual explica, paso a paso, cómo publicar un artículo y cómo consultarlo en el portal y en la app móvil.

## 1. Dónde está cada cosa

| Qué | Dónde | Quién lo usa |
|---|---|---|
| Editor de revistas (OJS) | http://localhost/ojs/index.php/horizontes | Editores y gestores |
| Portal de lectura | http://127.0.0.1:8000/revistas/horizontes | Lectores |
| App móvil Android | Expo Go en el celular (ver sección 5) | Lectores |

Para que el portal funcione, el servidor de Laravel debe estar encendido. En PowerShell, dentro de la carpeta `backend`:

```
php artisan serve
```

## 2. Publicar un artículo nuevo en OJS

1. **Crea el número** (solo la primera vez por número): *Números → Crear número*.
2. **Nuevo envío:** *Comenzar un nuevo envío* y elige la sección (Editorial, Comunicación breve, Artículos originales, Artículo de revisión o Tesis de egresados).
3. **Detalles:** escribe el título, las palabras clave (una por una, con Enter) y el resumen. Revisa que no tenga palabras pegadas.
4. **Cargar archivos:** sube el PDF y elige el tipo *Texto del artículo*.
5. **Colaboradores/as:** agrega a cada autor con nombre, apellidos, correo y país. Deja el rol *Autor/a*.
6. **Revisar y enviar:** revisa el resumen de todo y pulsa *Enviar*.
7. **Aceptar:** en *Envíos → Ver*, pulsa *Aceptar y omitir la revisión*, marca el PDF y pulsa *Registrar decisión*.
8. **Enviar a producción:** en la etapa de edición, pulsa *Enviar a producción*, marca el PDF en *Borradores finales* y registra la decisión.
9. **Asignar al número:** en *Publicación → Número*, pulsa *Asignar a número*, elige el número y guarda.
10. **Publicar:** pulsa *Programar para publicación* y confirma con *Publicar*.

Al terminar, el artículo ya está en OJS. Para verlo en el portal hay que sincronizar (sección 3).

## 3. Pasar los artículos de OJS al portal

Cada vez que publiques o cambies algo en OJS, en PowerShell dentro de la carpeta `backend` ejecuta:

```
php artisan ojs:sincronizar
```

Luego recarga la página del portal. El artículo aparece en la sección que se eligió en OJS.

## 4. Leer un artículo en el portal

1. Entra a http://127.0.0.1:8000/revistas/horizontes.
2. Elige un número y luego un artículo.
3. En la página del artículo puedes leer el resumen, el texto completo y abrir el PDF con *Descargar PDF*.

## 5. Usar la app móvil

Requisitos: el celular y la PC en la misma red Wi-Fi, y la app Expo Go instalada.

1. En la PC, en la carpeta `backend`, enciende el servidor para toda la red:
   `php artisan serve --host=0.0.0.0 --port=8000`
2. En la carpeta `app-movil` ejecuta `npx expo start` y escanea el código QR con Expo Go.
3. Dentro de la app puedes ver revistas, números y artículos, buscar, y con inicio de sesión guardar favoritos.

Si cambias de Wi-Fi, cambia también la IP en `app-movil/src/config.js`.

## 6. Problemas frecuentes

- **"No se pudo cargar"** en la app: revisa que el servidor esté encendido con `--host=0.0.0.0` y que la IP en `config.js` sea la correcta.
- **Un artículo nuevo no aparece en el portal:** falta ejecutar `php artisan ojs:sincronizar`.
- **No llegan correos de invitación en OJS:** el correo del servidor local no está configurado. No es necesario para publicar.
- **No puedo entrar al portal:** revisa tu correo y contraseña. Si cambiaste la contraseña, usa la nueva.
