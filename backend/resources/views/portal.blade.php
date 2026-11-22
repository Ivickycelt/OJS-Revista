@verbatim
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Horizontes | Revista de Ciencias del Colegio de Estudios de Postgrados Cuba-México</title>
<meta name="description" content="Horizontes, revista de ciencias del Colegio de Estudios de Postgrados Cuba-México (UICM).">
<style>
:root {
  --verde: #006633;
  --verde-oscuro: #004d26;
  --dorado: #f0ae5b;
  --texto: #222222;
  --fondo: #fbf8f3;
  --borde: #e6dfd3;
}
* { box-sizing: border-box; }
body {
  margin: 0;
  font-family: "Trebuchet MS", Verdana, Arial, sans-serif;
  color: var(--texto);
  background: var(--fondo);
  line-height: 1.55;
}
a { color: var(--verde); }
.contenedor { max-width: 1080px; margin: 0 auto; padding: 0 20px; }

/* ---------- Encabezado ---------- */
.cabecera {
  background: #ffffff;
  border-bottom: 4px solid var(--verde);
  position: sticky;
  top: 0;
  z-index: 10;
}
.cabecera .contenedor {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding-top: 10px;
  padding-bottom: 10px;
  flex-wrap: wrap;
}
.cabecera img { height: 56px; display: block; }
.acciones { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.saludo { color: var(--verde); font-weight: 700; }

.btn {
  background: var(--verde);
  color: #ffffff;
  border: 2px solid var(--verde);
  border-radius: 8px;
  padding: 8px 16px;
  font: inherit;
  font-weight: 700;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
}
.btn:hover { transform: translateY(-3px); box-shadow: 0 6px 14px rgba(0, 0, 0, 0.22); background: var(--verde-oscuro); }
.btn:active { transform: translateY(0); box-shadow: none; }
.btn-borde { background: #ffffff; color: var(--verde); }
.btn-borde:hover { background: #eef6f1; }
.btn[hidden] { display: none; }

/* ---------- Portada ---------- */
.portada {
  background: linear-gradient(135deg, var(--verde) 0%, var(--verde-oscuro) 65%);
  color: #ffffff;
  padding: 56px 0 48px;
  border-bottom: 6px solid var(--dorado);
}
.portada h1 { margin: 0 0 6px; font-size: clamp(2.4rem, 7vw, 4rem); letter-spacing: 0.02em; }
.portada p { margin: 0 0 16px; max-width: 640px; font-size: 1.05rem; }
.insignia {
  display: inline-block;
  background: var(--dorado);
  color: #2b1d00;
  font-weight: 700;
  border-radius: 999px;
  padding: 6px 16px;
}

/* ---------- Controles ---------- */
.controles { padding: 28px 0 8px; }
.fila { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
#buscar {
  flex: 1 1 260px;
  padding: 11px 14px;
  border: 2px solid var(--borde);
  border-radius: 8px;
  font: inherit;
  background: #ffffff;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
#buscar:focus { border-color: var(--verde); box-shadow: 0 0 0 3px rgba(0, 102, 51, 0.18); outline: none; }
.chips { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 14px; }
.filtro {
  border: 2px solid var(--verde);
  background: #ffffff;
  color: var(--verde);
  border-radius: 999px;
  padding: 5px 14px;
  font: inherit;
  cursor: pointer;
  transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s ease;
}
.filtro:hover { transform: translateY(-2px); }
.filtro.activo { background: var(--verde); color: #ffffff; }
#aviso { min-height: 1.4em; color: #9a2b00; font-weight: 700; margin: 10px 0 0; }

/* ---------- Tarjetas ---------- */
.rejilla {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 18px;
  padding: 18px 0 8px;
}
.card {
  background: #ffffff;
  border: 1px solid var(--borde);
  border-top: 4px solid var(--dorado);
  border-radius: 12px;
  padding: 18px;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  gap: 8px;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.card:hover, .card:focus-visible { transform: translateY(-5px); box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12); outline: none; }
.card h3 { margin: 0; font-size: 1.05rem; color: var(--verde-oscuro); }
.autores { margin: 0; color: #555555; font-size: 0.93rem; }
.pie-card { margin-top: auto; display: flex; justify-content: space-between; align-items: center; color: #666666; font-size: 0.9rem; }
.chip {
  align-self: flex-start;
  background: #fdf0dc;
  color: #6b4200;
  border-radius: 999px;
  padding: 2px 12px;
  font-size: 0.82rem;
  font-weight: 700;
}
.fav {
  border: 0;
  background: transparent;
  font-size: 1.6rem;
  line-height: 1;
  color: var(--verde);
  cursor: pointer;
  padding: 4px 8px;
}
.fav.activo { color: #c0392b; }
.fav.pop { animation: pop 0.35s ease; }
@keyframes pop { 0% { transform: scale(1); } 50% { transform: scale(1.5); } 100% { transform: scale(1); } }
.vacio { grid-column: 1 / -1; text-align: center; color: #666666; padding: 30px 0; }
.mas { display: block; margin: 18px auto 40px; }

/* Aparición suave al hacer scroll */
.reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.5s ease, transform 0.5s ease; }
.reveal.visible { opacity: 1; transform: none; }

/* ---------- Ventanas ---------- */
dialog {
  border: 0;
  border-radius: 14px;
  padding: 0;
  width: calc(100% - 32px);
  max-width: 640px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}
dialog::backdrop { background: rgba(0, 0, 0, 0.45); }
.dlg { padding: 24px; }
.dlg h2 { margin: 8px 0; color: var(--verde-oscuro); }
.meta { color: #666666; font-size: 0.92rem; }
.dlg label { display: block; margin: 12px 0 4px; font-weight: 700; }
.dlg input {
  width: 100%;
  padding: 10px 12px;
  border: 2px solid var(--borde);
  border-radius: 8px;
  font: inherit;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
.dlg input:focus { border-color: var(--verde); box-shadow: 0 0 0 3px rgba(0, 102, 51, 0.18); outline: none; }
.dlg .botones { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }
.enlace { background: none; border: 0; color: var(--verde); text-decoration: underline; cursor: pointer; font: inherit; padding: 0; margin-top: 14px; }
#auth-msg { color: #9a2b00; font-weight: 700; min-height: 1.3em; }

/* ---------- Pie ---------- */
.pie { background: var(--verde-oscuro); color: #ffffff; border-top: 5px solid var(--dorado); padding: 26px 0; font-size: 0.9rem; }
.pie a { color: var(--dorado); }

/* Accesibilidad: respetar "reducir movimiento" */
@media (prefers-reduced-motion: reduce) {
  * { transition: none !important; animation: none !important; }
  .reveal { opacity: 1; transform: none; }
}
</style>
</head>
<body>

<header class="cabecera">
  <div class="contenedor">
    <img src="/images/logo-ucm.png" alt="Universidad Internacional Cuba-México">
    <div class="acciones">
      <button id="btn-favoritos" class="btn btn-borde" type="button" hidden>Mis favoritos</button>
      <div id="sesion" class="acciones"></div>
    </div>
  </div>
</header>

<section class="portada">
  <div class="contenedor">
    <h1>Horizontes</h1>
    <p>Revista de Ciencias del Colegio de Estudios de Postgrados Cuba-México. Publicación semestral de acceso abierto y sin cargos por procesamiento ni publicación.</p>
    <span class="insignia" id="numero">Cargando número...</span>
  </div>
</section>

<main class="contenedor">
  <noscript><p>Esta página necesita JavaScript para mostrar los artículos.</p></noscript>
  <div class="controles">
    <div class="fila">
      <input id="buscar" type="search" placeholder="Buscar por título o autor..." aria-label="Buscar artículos">
    </div>
    <div class="chips" id="chips" aria-label="Filtrar por sección"></div>
    <p id="aviso" role="status"></p>
  </div>

  <div class="rejilla" id="lista" aria-live="polite"></div>
  <button id="mas" class="btn mas" type="button" hidden>Ver más artículos</button>
</main>

<footer class="pie">
  <div class="contenedor">
    <p><strong>Horizontes</strong>, Año 2026, Núm. 1, enero-junio de 2026 · ISSN 3122-4822</p>
    <p>Colegio de Estudios de Postgrados Cuba-México · Calle Dolores 46, San Cristóbal Nexquipayac, Atenco, Estado de México, C.P. 56315</p>
    <p><a href="https://www.uicm.edu.mx" target="_blank" rel="noopener">www.uicm.edu.mx</a> · revistahorizontesuicm@gmail.com</p>
  </div>
</footer>

<dialog id="detalle" aria-labelledby="detalle-titulo">
  <div class="dlg">
    <div id="detalle-contenido"></div>
    <div class="botones"><button id="detalle-cerrar" class="btn btn-borde" type="button">Cerrar</button></div>
  </div>
</dialog>

<dialog id="auth" aria-labelledby="auth-titulo">
  <form id="auth-form" class="dlg">
    <h2 id="auth-titulo">Iniciar sesión</h2>
    <p id="auth-msg" role="alert"></p>
    <div id="campos-registro" hidden>
      <label for="nombre">Nombre</label>
      <input id="nombre" type="text" autocomplete="name" maxlength="255">
    </div>
    <label for="correo">Correo electrónico</label>
    <input id="correo" type="email" autocomplete="email" required>
    <label for="clave">Contraseña</label>
    <input id="clave" type="password" autocomplete="current-password" required>
    <div id="campos-confirmacion" hidden>
      <label for="confirmacion">Repite la contraseña</label>
      <input id="confirmacion" type="password" autocomplete="new-password">
    </div>
    <div class="botones">
      <button id="auth-enviar" class="btn" type="submit">Entrar</button>
      <button id="auth-cerrar" class="btn btn-borde" type="button">Cancelar</button>
    </div>
    <button id="auth-cambiar" class="enlace" type="button">¿No tienes cuenta? Regístrate</button>
  </form>
</dialog>

<script>
(function () {
  'use strict';

  var API = '/api';
  var estado = {
    seccion: '', texto: '', pagina: 1, ultima: 1,
    soloFavoritos: false, favoritos: new Set(),
    token: null, usuario: null, modo: 'login'
  };
  var $ = function (id) { return document.getElementById(id); };

  // Crea elementos sin usar innerHTML (así los datos de la API nunca se interpretan como código).
  function el(etiqueta, props) {
    var nodo = document.createElement(etiqueta);
    Object.keys(props || {}).forEach(function (k) {
      var v = props[k];
      if (k === 'class') nodo.className = v;
      else if (k.indexOf('on') === 0) nodo.addEventListener(k.slice(2), v);
      else nodo.setAttribute(k, v);
    });
    for (var i = 2; i < arguments.length; i++) {
      var hijo = arguments[i];
      if (hijo !== null && hijo !== undefined && hijo !== '') nodo.append(hijo);
    }
    return nodo;
  }

  // ---------- Sesión (el token se guarda en el navegador) ----------
  function leerSesion() {
    try {
      estado.token = localStorage.getItem('hz_token');
      var u = localStorage.getItem('hz_usuario');
      estado.usuario = u ? JSON.parse(u) : null;
    } catch (e) { estado.token = null; estado.usuario = null; }
  }
  function guardarSesion(token, usuario) {
    estado.token = token; estado.usuario = usuario;
    try {
      if (token) {
        localStorage.setItem('hz_token', token);
        localStorage.setItem('hz_usuario', JSON.stringify(usuario));
      } else {
        localStorage.removeItem('hz_token');
        localStorage.removeItem('hz_usuario');
      }
    } catch (e) { /* si el navegador no deja guardar, la sesión dura hasta recargar */ }
  }

  // ---------- Llamadas a la API ----------
  async function api(ruta, opciones) {
    opciones = opciones || {};
    var cabeceras = { Accept: 'application/json' };
    if (opciones.body) cabeceras['Content-Type'] = 'application/json';
    if (estado.token) cabeceras.Authorization = 'Bearer ' + estado.token;
    var resp = await fetch(API + ruta, { method: opciones.method || 'GET', headers: cabeceras, body: opciones.body });
    var datos = null;
    try { datos = await resp.json(); } catch (e) { datos = null; }
    if (!resp.ok) {
      var err = new Error((datos && datos.message) || ('Error ' + resp.status));
      err.status = resp.status; err.datos = datos;
      throw err;
    }
    return datos;
  }

  var temporizadorAviso = null;
  function aviso(texto) {
    $('aviso').textContent = texto || '';
    clearTimeout(temporizadorAviso);
    if (texto) temporizadorAviso = setTimeout(function () { $('aviso').textContent = ''; }, 6000);
  }

  // ---------- Aparición al hacer scroll ----------
  var observador = null;
  if ('IntersectionObserver' in window && !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
    observador = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('visible'); observador.unobserve(e.target); }
      });
    }, { threshold: 0.08 });
  }
  function revelar(nodo) {
    if (observador) observador.observe(nodo);
    else nodo.classList.add('visible');
  }

  // ---------- Interfaz de sesión ----------
  function pintarSesion() {
    var caja = $('sesion');
    caja.replaceChildren();
    if (estado.usuario) {
      caja.append(
        el('span', { 'class': 'saludo' }, 'Hola, ' + estado.usuario.name),
        el('button', { 'class': 'btn btn-borde', type: 'button', onclick: cerrarSesion }, 'Salir')
      );
    } else {
      caja.append(el('button', { 'class': 'btn', type: 'button', onclick: function () { abrirAuth('login'); } }, 'Entrar'));
    }
    $('btn-favoritos').hidden = !estado.usuario;
    $('btn-favoritos').textContent = estado.soloFavoritos ? 'Ver todos' : 'Mis favoritos';
  }

  function abrirAuth(modo, mensaje) {
    estado.modo = modo;
    pintarModoAuth();
    $('auth-msg').textContent = mensaje || '';
    $('auth').showModal();
  }
  function pintarModoAuth() {
    var registro = estado.modo === 'register';
    $('campos-registro').hidden = !registro;
    $('campos-confirmacion').hidden = !registro;
    $('nombre').required = registro;
    $('confirmacion').required = registro;
    $('auth-titulo').textContent = registro ? 'Crear cuenta' : 'Iniciar sesión';
    $('auth-enviar').textContent = registro ? 'Registrarme' : 'Entrar';
    $('auth-cambiar').textContent = registro ? '¿Ya tienes cuenta? Inicia sesión' : '¿No tienes cuenta? Regístrate';
    $('clave').autocomplete = registro ? 'new-password' : 'current-password';
  }

  async function enviarAuth(ev) {
    ev.preventDefault();
    var registro = estado.modo === 'register';
    var cuerpo = { email: $('correo').value.trim(), password: $('clave').value };
    if (registro) {
      cuerpo.name = $('nombre').value.trim();
      cuerpo.password_confirmation = $('confirmacion').value;
    }
    $('auth-msg').textContent = '';
    try {
      var r = await api(registro ? '/register' : '/login', { method: 'POST', body: JSON.stringify(cuerpo) });
      guardarSesion(r.token, r.user);
      $('clave').value = '';
      $('confirmacion').value = '';
      $('auth').close();
      pintarSesion();
      await cargarFavoritosIds();
      cargarArticulos(true);
    } catch (e) {
      var texto = e.message;
      if (e.datos && e.datos.errors) texto = Object.values(e.datos.errors).flat().join(' ');
      $('auth-msg').textContent = texto;
    }
  }

  async function cerrarSesion() {
    try { await api('/logout', { method: 'POST' }); } catch (e) { /* aunque falle, cerramos la sesión local */ }
    guardarSesion(null, null);
    estado.favoritos = new Set();
    estado.soloFavoritos = false;
    pintarSesion();
    cargarArticulos(true);
  }

  // ---------- Datos de la revista ----------
  async function cargarNumero() {
    try {
      var r = await api('/issues');
      var n = r.data[0];
      if (n) $('numero').textContent = 'Vol. ' + n.volume + ', Núm. ' + n.number + ' · ' + (n.title || n.year);
    } catch (e) { $('numero').textContent = ''; }
  }

  function marcarChips() {
    document.querySelectorAll('#chips .filtro').forEach(function (b) {
      b.classList.toggle('activo', b.getAttribute('data-slug') === estado.seccion);
    });
  }
  function chip(slug, nombre) {
    return el('button', {
      'class': 'filtro', type: 'button', 'data-slug': slug,
      onclick: function () { estado.seccion = slug; marcarChips(); cargarArticulos(true); }
    }, nombre);
  }
  async function cargarSecciones() {
    try {
      var r = await api('/sections');
      var caja = $('chips');
      caja.replaceChildren(chip('', 'Todas'));
      r.data.forEach(function (s) { caja.append(chip(s.slug, s.name)); });
      marcarChips();
    } catch (e) { aviso('No se pudieron cargar las secciones.'); }
  }

  async function cargarFavoritosIds() {
    estado.favoritos = new Set();
    if (!estado.token) return;
    try {
      var r = await api('/favorites');
      r.data.forEach(function (a) { estado.favoritos.add(a.id); });
    } catch (e) {
      if (e.status === 401) { guardarSesion(null, null); pintarSesion(); }
    }
  }

  function coincide(a) {
    var t = estado.texto.toLowerCase();
    var enSeccion = !estado.seccion || (a.section && a.section.slug === estado.seccion);
    var enTexto = !t || a.title.toLowerCase().indexOf(t) !== -1 ||
      (a.authors || []).some(function (n) { return n.toLowerCase().indexOf(t) !== -1; });
    return enSeccion && enTexto;
  }

  async function cargarArticulos(reiniciar) {
    var lista = $('lista');
    if (reiniciar) { estado.pagina = 1; lista.replaceChildren(); }
    try {
      var articulos, ultima = 1;
      if (estado.soloFavoritos) {
        var rf = await api('/favorites');
        articulos = rf.data.filter(coincide);
      } else {
        var p = new URLSearchParams({ page: estado.pagina });
        if (estado.seccion) p.set('section', estado.seccion);
        if (estado.texto) p.set('search', estado.texto);
        var r = await api('/articles?' + p.toString());
        articulos = r.data;
        ultima = r.meta ? r.meta.last_page : 1;
      }
      estado.ultima = ultima;
      articulos.forEach(function (a) {
        var t = tarjeta(a);
        lista.append(t);
        revelar(t);
      });
      if (!lista.children.length) {
        lista.append(el('p', { 'class': 'vacio' }, estado.soloFavoritos ? 'Aún no tienes artículos favoritos.' : 'No se encontraron artículos.'));
      }
      $('mas').hidden = estado.soloFavoritos || estado.pagina >= estado.ultima;
    } catch (e) {
      aviso('No se pudieron cargar los artículos: ' + e.message);
    }
  }

  function tarjeta(a) {
    var esFav = estado.favoritos.has(a.id);
    var corazon = el('button', {
      'class': 'fav' + (esFav ? ' activo' : ''), type: 'button',
      'aria-pressed': String(esFav),
      'aria-label': esFav ? 'Quitar de favoritos' : 'Agregar a favoritos',
      onclick: function (ev) { ev.stopPropagation(); alternarFavorito(a.id, corazon); }
    }, esFav ? '\u2665' : '\u2661');

    return el('article', {
      'class': 'card reveal', tabindex: '0',
      onclick: function () { abrirDetalle(a.id); },
      onkeydown: function (ev) { if (ev.key === 'Enter') abrirDetalle(a.id); }
    },
      el('span', { 'class': 'chip' }, a.section ? a.section.name : ''),
      el('h3', {}, a.title),
      el('p', { 'class': 'autores' }, (a.authors || []).join(', ')),
      el('div', { 'class': 'pie-card' }, el('span', {}, a.start_page ? 'Pág. ' + a.start_page : ''), corazon)
    );
  }

  async function alternarFavorito(id, boton) {
    if (!estado.token) { abrirAuth('login', 'Inicia sesión para guardar favoritos.'); return; }
    var esFav = estado.favoritos.has(id);
    try {
      await api('/favorites/' + id, { method: esFav ? 'DELETE' : 'POST' });
      if (esFav) estado.favoritos.delete(id); else estado.favoritos.add(id);
      boton.classList.toggle('activo', !esFav);
      boton.textContent = !esFav ? '\u2665' : '\u2661';
      boton.setAttribute('aria-pressed', String(!esFav));
      boton.classList.remove('pop');
      void boton.offsetWidth;
      boton.classList.add('pop');
      if (estado.soloFavoritos && esFav) cargarArticulos(true);
    } catch (e) {
      if (e.status === 401) { guardarSesion(null, null); pintarSesion(); abrirAuth('login', 'Tu sesión expiró. Inicia sesión otra vez.'); }
      else aviso(e.message);
    }
  }

  async function abrirDetalle(id) {
    try {
      var r = await api('/articles/' + id);
      var a = r.data;
      var meta = '';
      if (a.issue) {
        meta = 'Vol. ' + a.issue.volume + ', Núm. ' + a.issue.number + ' (' + a.issue.year + ')';
        if (a.start_page) meta += ' · Pág. ' + a.start_page;
      }
      var enlacePdf = (a.pdf_url && /^https?:\/\//i.test(a.pdf_url))
        ? el('p', {}, el('a', { href: a.pdf_url, target: '_blank', rel: 'noopener' }, 'Abrir PDF'))
        : '';
      $('detalle-contenido').replaceChildren(
        el('span', { 'class': 'chip' }, a.section ? a.section.name : ''),
        el('h2', { id: 'detalle-titulo' }, a.title),
        el('p', { 'class': 'autores' }, (a.authors || []).join(', ')),
        el('p', { 'class': 'meta' }, meta),
        el('p', {}, a.abstract || 'Resumen no disponible en esta versión.'),
        enlacePdf
      );
      $('detalle').showModal();
    } catch (e) { aviso(e.message); }
  }

  // ---------- Eventos ----------
  var espera = null;
  $('buscar').addEventListener('input', function () {
    clearTimeout(espera);
    espera = setTimeout(function () {
      estado.texto = $('buscar').value.trim();
      cargarArticulos(true);
    }, 300);
  });
  $('mas').addEventListener('click', function () { estado.pagina += 1; cargarArticulos(false); });
  $('btn-favoritos').addEventListener('click', function () {
    estado.soloFavoritos = !estado.soloFavoritos;
    pintarSesion();
    cargarArticulos(true);
  });
  $('auth-form').addEventListener('submit', enviarAuth);
  $('auth-cerrar').addEventListener('click', function () { $('auth').close(); });
  $('auth-cambiar').addEventListener('click', function () {
    estado.modo = estado.modo === 'login' ? 'register' : 'login';
    $('auth-msg').textContent = '';
    pintarModoAuth();
  });
  $('detalle-cerrar').addEventListener('click', function () { $('detalle').close(); });

  // ---------- Inicio ----------
  (async function iniciar() {
    leerSesion();
    pintarSesion();
    await Promise.all([cargarNumero(), cargarSecciones(), cargarFavoritosIds()]);
    pintarSesion();
    cargarArticulos(true);
  })();
})();
</script>
</body>
</html>
@endverbatim
