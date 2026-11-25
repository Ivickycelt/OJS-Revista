# Revista nueva: Revista Académica Abierta

## Datos de la revista

| Campo | Valor |
|---|---|
| Nombre | Revista Académica Abierta |
| Abreviatura | RAA |
| Ruta (slug) | academica-abierta |
| Descripción | Revista académica de acceso abierto que publica trabajos de investigación, ensayos, reseñas y comunicaciones de distintas disciplinas. |
| ISSN | Pendiente (por ahora no se registra) |
| Correo de contacto | Postdanger61@gmail.com |
| Periodicidad | No definida |
| Secciones | Artículos originales; Artículos de revisión; Ensayos; Reseñas; Editorial; Comunicaciones breves |
| Idiomas | Español e inglés (idioma principal: español) |

## Pasos en OJS (panel de administración)

1. **Administración del sitio > Idiomas:** activa español e inglés si no están activos.
2. **Administración > Revistas alojadas > Crear revista:** nombre "Revista Académica Abierta", ruta `academica-abierta`, idioma principal español.
3. **Entra a la revista > Configuración > Información:** pega la descripción, el correo de contacto y la abreviatura RAA.
4. **Configuración > Idioma:** marca español e inglés, y deja español como idioma principal.
5. **Configuración > Secciones:** crea las seis secciones de la tabla. En **Abreviatura** escribe el código de cada una, porque así las reconoce el portal:
   - Artículos originales: `ORIG`
   - Artículos de revisión: `REV`
   - Ensayos: `ENS`
   - Reseñas: `RES`
   - Editorial: `EDIT`
   - Comunicaciones breves: `COM`
6. **Usuarios:** asigna tu usuario de administrador como Gestor de la revista.
7. **Números:** crea un número nuevo cuando haya artículos listos.

*Los nombres de los menús pueden variar un poco en OJS 3.5. Si no encuentras alguna opción, dime qué ves.*

## Crear la revista en el portal

Después de crearla en OJS, dale de alta en el portal (en la carpeta `backend`):

```
php artisan tinker
App\Models\Journal::create(['name' => 'Revista Académica Abierta', 'slug' => 'academica-abierta', 'abbreviation' => 'RAA', 'country' => 'México', 'description' => 'Revista académica de acceso abierto que publica trabajos de investigación, ensayos, reseñas y comunicaciones de distintas disciplinas.', 'contact_email' => 'Postdanger61@gmail.com', 'color' => '#1A44D8', 'accent' => '#00A087']);
exit
```

Luego importa los artículos publicados con:

```
php artisan ojs:sincronizar academica-abierta
```

## Estado del código

El comando `ojs:sincronizar` ya recibe la ruta de la revista como parámetro y crea sus secciones en el portal. Se probó con la revista nueva en cuanto tengas PHP y XAMPP encendidos.
