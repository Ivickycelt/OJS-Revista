@verbatim
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Revistas | Universidad Internacional Cuba-México</title>
<meta name="description" content="Portal de revistas de la Universidad Internacional Cuba-México (UICM).">
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
  max-height: 88vh;
  overflow-y: auto;
  border: 0;
  border-radius: 14px;
  padding: 0;
  width: calc(100% - 32px);
  max-width: 640px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}
dialog::backdrop { background: rgba(0, 0, 0, 0.45); }
#detalle { max-width: 940px; }
.visor-pdf {
  display: block;
  width: 100%;
  height: 72vh;
  min-height: 420px;
  border: 1px solid var(--borde);
  border-radius: 8px;
  margin: 12px 0;
  background: #f4f4f4;
}
.texto-plano { margin-top: 14px; }
.texto-plano summary { cursor: pointer; color: var(--verde); font-weight: 700; }
.texto-plano p { font-size: 0.97rem; }
@media (max-width: 600px) { .visor-pdf { height: 60vh; min-height: 320px; } }
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

/* ---------- Portal multirrevista ---------- */
.card { position: relative; }
.card h3 a { color: var(--verde-oscuro); text-decoration: none; }
.card h3 a::after { content: ""; position: absolute; inset: 0; border-radius: 12px; }
.card h3 a:focus { outline: none; }
.card h3 a:focus-visible::after { box-shadow: inset 0 0 0 3px var(--verde); }
.fav { position: relative; z-index: 2; }
.meta-revista { color: #555555; font-size: 0.92rem; margin: 0; display: flex; gap: 14px; flex-wrap: wrap; }
.subtitulo { color: var(--verde-oscuro); margin: 28px 0 0; font-size: 1.5rem; }
.portada .meta-portada { margin-top: 10px; font-size: 0.95rem; opacity: 0.92; }
.migas { padding: 16px 0 0; font-size: 0.92rem; color: #666666; }
.migas a { color: var(--verde); }
.titulo-articulo { color: var(--verde-oscuro); font-size: clamp(1.6rem, 4vw, 2.3rem); line-height: 1.2; margin: 12px 0 8px; }
.acciones-articulo { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin: 16px 0 4px; }
.acciones-articulo .btn { text-decoration: none; display: inline-block; }
.fav-grande { border: 2px solid var(--borde); border-radius: 10px; background: #ffffff; font-size: 1.8rem; padding: 4px 12px; }
.fav-grande.activo { border-color: #c0392b; }
#selector-numero { flex: 0 1 280px; padding: 11px 12px; border: 2px solid var(--borde); border-radius: 8px; font: inherit; background: #ffffff; }
.volver { display: inline-block; margin: 18px 0 40px; text-decoration: none; }
.pie p { margin: 4px 0; }
.vacio { color: #666666; }
</style>
</head>
<body>

<header class="cabecera">
  <div class="contenedor">
    <a href="/" aria-label="Inicio del portal de revistas"><img src="/images/logo-ucm.png" alt="Universidad Internacional Cuba-México"></a>
    <div class="acciones"><div id="sesion" class="acciones"></div></div>
  </div>
</header>

<div id="app">
  <noscript><p class="contenedor">Esta página necesita JavaScript para mostrar las revistas y los artículos.</p></noscript>
</div>

<footer class="pie">
  <div class="contenedor">
    <p><strong>Universidad Internacional Cuba-México</strong></p>
    <p>Calle Dolores 46, San Cristóbal Nexquipayac, Atenco, Estado de México, C.P. 56315</p>
    <p><a href="https://www.uicm.edu.mx" target="_blank" rel="noopener">www.uicm.edu.mx</a></p>
  </div>
</footer>

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
  var app = document.getElementById('app');
  var estado = {
    revista: null, numeros: [], numero: '',
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
    (function agregar(lista) {
      lista.forEach(function (hijo) {
        if (Array.isArray(hijo)) agregar(hijo);
        else if (hijo !== null && hijo !== undefined && hijo !== '') nodo.append(hijo);
      });
    })(Array.prototype.slice.call(arguments, 2));
    return nodo;
  }

  function colorValido(c, respaldo) {
    return /^#[0-9a-fA-F]{6}$/.test(c || '') ? c : respaldo;
  }
  // Cada revista puede tener sus colores; si no hay revista, se usan los de la UICM.
  function aplicarColores(revista) {
    var raiz = document.documentElement.style;
    if (revista) {
      raiz.setProperty('--verde', colorValido(revista.color, '#006633'));
      raiz.setProperty('--dorado', colorValido(revista.accent, '#f0ae5b'));
    } else {
      raiz.removeProperty('--verde');
      raiz.removeProperty('--dorado');
    }
  }
  function etiquetaNumero(n) {
    return 'Vol. ' + n.volume + ', Núm. ' + n.number + ' (' + n.year + ')';
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
    var caja = $('aviso');
    if (!caja) return;
    caja.textContent = texto || '';
    clearTimeout(temporizadorAviso);
    if (texto) temporizadorAviso = setTimeout(function () { caja.textContent = ''; }, 6000);
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

  // ---------- Encabezado y sesión ----------
  function pintarSesion() {
    var caja = $('sesion');
    if (!caja) return;
    caja.replaceChildren();
    if (estado.usuario) {
      caja.append(
        el('span', { 'class': 'saludo' }, 'Hola, ' + estado.usuario.name),
        el('button', { 'class': 'btn btn-borde', type: 'button', onclick: cerrarSesion }, 'Salir')
      );
    } else {
      caja.append(el('button', { 'class': 'btn', type: 'button', onclick: function () { abrirAuth('login'); } }, 'Entrar'));
    }
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
      renderizar();
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
    renderizar();
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

  // ---------- Enrutador: según la dirección se dibuja una vista ----------
  function rutaActual() {
    var partes = location.pathname.split('/').filter(Boolean);
    if (partes.length === 0) return { vista: 'inicio' };
    if (partes[0] === 'revistas' && partes.length === 2) return { vista: 'revista', slug: partes[1] };
    if (partes[0] === 'revistas' && partes.length === 4 && partes[2] === 'articulos') {
      return { vista: 'articulo', slug: partes[1], id: partes[3] };
    }
    return { vista: 'no' };
  }

  function renderizar() {
    var r = rutaActual();
    if (r.vista === 'inicio') return vistaInicio();
    if (r.vista === 'revista') return vistaRevista(r.slug);
    if (r.vista === 'articulo') return vistaArticulo(r.slug, r.id);
    return vistaNoEncontrada('La dirección que buscas no existe.');
  }

  function vistaNoEncontrada(mensaje) {
    document.title = 'Página no encontrada | Universidad Internacional Cuba-México';
    aplicarColores(null);
    app.replaceChildren(
      el('section', { 'class': 'portada' }, el('div', { 'class': 'contenedor' },
        el('h1', {}, 'No encontrado'),
        el('p', {}, mensaje))),
      el('main', { 'class': 'contenedor' },
        el('a', { 'class': 'btn volver', href: '/' }, 'Ver todas las revistas'))
    );
  }

  // ---------- Vista 1: todas las revistas ----------
  function tarjetaRevista(j) {
    var color = colorValido(j.color, '#f0ae5b');
    var numeros = j.issues_count || 0;
    return el('article', { 'class': 'card reveal', style: 'border-top-color:' + color },
      el('h3', {}, el('a', { href: '/revistas/' + j.slug }, j.name)),
      el('p', { 'class': 'meta-revista' },
        el('span', {}, j.issn ? 'ISSN ' + j.issn : ''),
        el('span', {}, numeros + (numeros === 1 ? ' número' : ' números'))),
      el('p', { 'class': 'autores' }, j.description || '')
    );
  }

  async function vistaInicio() {
    document.title = 'Revistas | Universidad Internacional Cuba-México';
    aplicarColores(null);
    estado.revista = null;
    app.replaceChildren(
      el('section', { 'class': 'portada' }, el('div', { 'class': 'contenedor' },
        el('h1', {}, 'Revistas UICM'),
        el('p', {}, 'Publicaciones académicas de la Universidad Internacional Cuba-México. Acceso abierto, gratuito y sin cargos por publicar.'))),
      el('main', { 'class': 'contenedor' },
        el('h2', { 'class': 'subtitulo' }, 'Elige una revista'),
        el('p', { id: 'aviso', role: 'status' }),
        el('div', { 'class': 'rejilla', id: 'lista' }))
    );
    try {
      var r = await api('/revistas');
      var caja = $('lista');
      if (!r.data.length) caja.append(el('p', { 'class': 'vacio' }, 'Todavía no hay revistas publicadas.'));
      r.data.forEach(function (j) { var t = tarjetaRevista(j); caja.append(t); revelar(t); });
    } catch (e) { aviso('No se pudieron cargar las revistas.'); }
  }

  // ---------- Vista 2: una revista (números, secciones, búsqueda y artículos) ----------
  function chip(slug, nombre) {
    return el('button', {
      'class': 'filtro', type: 'button', 'data-slug': slug,
      onclick: function () { estado.seccion = slug; marcarChips(); cargarArticulos(true); }
    }, nombre);
  }
  function marcarChips() {
    document.querySelectorAll('#chips .filtro').forEach(function (b) {
      b.classList.toggle('activo', b.getAttribute('data-slug') === estado.seccion);
    });
  }
  async function cargarSecciones() {
    try {
      var r = await api('/revistas/' + estado.revista.slug + '/secciones');
      var caja = $('chips');
      if (!caja) return;
      caja.replaceChildren(chip('', 'Todas'));
      r.data.forEach(function (s) { caja.append(chip(s.slug, s.name)); });
      marcarChips();
    } catch (e) { aviso('No se pudieron cargar las secciones.'); }
  }

  function pintarBotonFavoritos() {
    var b = $('btn-favoritos');
    if (!b) return;
    b.hidden = !estado.usuario;
    b.textContent = estado.soloFavoritos ? 'Ver todos los artículos' : 'Mis favoritos';
  }

  function coincide(a) {
    if (estado.revista && a.journal_slug && a.journal_slug !== estado.revista.slug) return false;
    var t = estado.texto.toLowerCase();
    var enSeccion = !estado.seccion || (a.section && a.section.slug === estado.seccion);
    var enTexto = !t || a.title.toLowerCase().indexOf(t) !== -1 ||
      (a.authors || []).some(function (n) { return n.toLowerCase().indexOf(t) !== -1; });
    return enSeccion && enTexto;
  }

  async function cargarArticulos(reiniciar) {
    var lista = $('lista');
    if (!lista || !estado.revista) return;
    if (reiniciar) { estado.pagina = 1; lista.replaceChildren(); }
    try {
      var articulos, ultima = 1;
      if (estado.soloFavoritos) {
        var rf = await api('/favorites');
        articulos = rf.data.filter(coincide);
      } else {
        var p = new URLSearchParams({ page: estado.pagina, journal: estado.revista.slug });
        if (estado.numero) p.set('issue', estado.numero);
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
        lista.append(el('p', { 'class': 'vacio' }, estado.soloFavoritos
          ? 'Aún no tienes artículos favoritos en esta revista.'
          : 'No se encontraron artículos con esos filtros.'));
      }
      var mas = $('mas');
      if (mas) mas.hidden = estado.soloFavoritos || estado.pagina >= estado.ultima;
    } catch (e) {
      aviso('No se pudieron cargar los artículos: ' + e.message);
    }
  }

  function tarjeta(a) {
    var corazon = botonFavorito(a.id, estado.favoritos.has(a.id), 'fav');
    var revista = a.journal_slug || estado.revista.slug;
    return el('article', { 'class': 'card reveal' },
      el('span', { 'class': 'chip' }, a.section ? a.section.name : ''),
      el('h3', {}, el('a', { 'class': 'enlace-fuerte', href: '/revistas/' + revista + '/articulos/' + a.id }, a.title)),
      el('p', { 'class': 'autores' }, (a.authors || []).join(', ')),
      el('div', { 'class': 'pie-card' }, el('span', {}, a.start_page ? 'Pág. ' + a.start_page : ''), corazon)
    );
  }

  function botonFavorito(id, esFav, clase) {
    var boton = el('button', {
      'class': clase + (esFav ? ' activo' : ''), type: 'button',
      'aria-pressed': String(esFav),
      'aria-label': esFav ? 'Quitar de favoritos' : 'Agregar a favoritos',
      onclick: function (ev) { ev.preventDefault(); ev.stopPropagation(); alternarFavorito(id, boton); }
    }, esFav ? '♥' : '♡');
    return boton;
  }

  async function alternarFavorito(id, boton) {
    if (!estado.token) { abrirAuth('login', 'Inicia sesión para guardar favoritos.'); return; }
    var esFav = estado.favoritos.has(id);
    try {
      await api('/favorites/' + id, { method: esFav ? 'DELETE' : 'POST' });
      if (esFav) estado.favoritos.delete(id); else estado.favoritos.add(id);
      boton.classList.toggle('activo', !esFav);
      boton.textContent = !esFav ? '♥' : '♡';
      boton.setAttribute('aria-pressed', String(!esFav));
      boton.setAttribute('aria-label', !esFav ? 'Quitar de favoritos' : 'Agregar a favoritos');
      boton.classList.remove('pop');
      void boton.offsetWidth;
      boton.classList.add('pop');
      if (estado.soloFavoritos && esFav) cargarArticulos(true);
    } catch (e) {
      if (e.status === 401) { guardarSesion(null, null); pintarSesion(); abrirAuth('login', 'Tu sesión expiró. Inicia sesión otra vez.'); }
      else aviso(e.message);
    }
  }

  async function vistaRevista(slug) {
    if (!/^[a-z0-9-]+$/.test(slug)) return vistaNoEncontrada('Esa revista no existe.');
    estado.seccion = ''; estado.texto = ''; estado.pagina = 1;

    try {
      estado.revista = (await api('/revistas/' + slug)).data;
    } catch (e) {
      return vistaNoEncontrada('No encontramos esa revista. Revisa la dirección o vuelve a la lista.');
    }
    try { estado.numeros = (await api('/revistas/' + slug + '/numeros')).data; }
    catch (e) { estado.numeros = []; }

    var j = estado.revista;
    var ultimo = estado.numeros[0];
    estado.numero = ultimo ? String(ultimo.id) : '';
    estado.soloFavoritos = !!estado.usuario && new URLSearchParams(location.search).get('favoritos') === '1';
    aplicarColores(j);
    document.title = j.name + ' | Universidad Internacional Cuba-México';

    var selector = el('select', {
      id: 'selector-numero', 'aria-label': 'Elegir número',
      onchange: function () { estado.numero = $('selector-numero').value; cargarArticulos(true); }
    },
      el('option', { value: '' }, 'Todos los números'),
      estado.numeros.map(function (n) { return el('option', { value: String(n.id) }, etiquetaNumero(n)); })
    );
    selector.value = estado.numero;

    var btnFav = el('button', {
      id: 'btn-favoritos', 'class': 'btn btn-borde', type: 'button',
      onclick: function () {
        estado.soloFavoritos = !estado.soloFavoritos;
        history.replaceState(null, '', estado.soloFavoritos ? location.pathname + '?favoritos=1' : location.pathname);
        pintarBotonFavoritos();
        cargarArticulos(true);
      }
    });

    var portada = el('section', { 'class': 'portada' }, el('div', { 'class': 'contenedor' },
      el('h1', {}, j.name),
      el('p', {}, j.description || ''),
      el('p', { 'class': 'meta-portada' }, [j.issn ? 'ISSN ' + j.issn : '', j.publisher || ''].filter(Boolean).join(' · ')),
      el('span', { 'class': 'insignia' }, ultimo ? 'Último número: ' + etiquetaNumero(ultimo) : 'Próximamente')
    ));

    var principal = el('main', { 'class': 'contenedor' },
      el('nav', { 'class': 'migas', 'aria-label': 'Ruta' },
        el('a', { href: '/' }, 'Revistas'), ' › ', j.name),
      el('div', { 'class': 'controles' },
        el('div', { 'class': 'fila' },
          selector,
          el('input', { id: 'buscar', type: 'search', placeholder: 'Buscar por título o autor...', 'aria-label': 'Buscar artículos' }),
          btnFav),
        el('div', { 'class': 'chips', id: 'chips', 'aria-label': 'Filtrar por sección' }),
        el('p', { id: 'aviso', role: 'status' })),
      el('div', { 'class': 'rejilla', id: 'lista', 'aria-live': 'polite' }),
      el('button', { id: 'mas', 'class': 'btn mas', type: 'button', onclick: function () { estado.pagina += 1; cargarArticulos(false); } }, 'Ver más artículos')
    );

    app.replaceChildren(portada, principal);
    pintarBotonFavoritos();
    $('mas').hidden = true;

    var espera = null;
    $('buscar').addEventListener('input', function () {
      clearTimeout(espera);
      espera = setTimeout(function () {
        estado.texto = $('buscar').value.trim();
        cargarArticulos(true);
      }, 300);
    });

    await cargarSecciones();
    cargarArticulos(true);
  }

  // ---------- Vista 3: un artículo, con su PDF original ----------
  async function vistaArticulo(slug, id) {
    if (!/^[a-z0-9-]+$/.test(slug) || !/^\d+$/.test(id)) return vistaNoEncontrada('Ese artículo no existe.');

    var a;
    try { a = (await api('/articles/' + id)).data; }
    catch (e) { return vistaNoEncontrada('No encontramos ese artículo. Puede que haya sido retirado.'); }

    var revista = a.journal_slug || slug;
    var nombre = a.journal_name || 'Revista';
    estado.revista = null;
    document.title = a.title + ' | ' + nombre;
    try { aplicarColores((await api('/revistas/' + revista)).data); }
    catch (e) { aplicarColores(null); }

    var corazon = botonFavorito(a.id, estado.favoritos.has(a.id), 'fav fav-grande');
    var numero = a.issue ? etiquetaNumero(a.issue) : '';

    var contenido = [];
    if (a.pdf_url) {
      // Se muestran las páginas originales de la revista, tal cual se publicaron.
      contenido.push(el('iframe', { 'class': 'visor-pdf', src: a.pdf_url + '#view=FitH', title: 'PDF de ' + a.title }));
    }
    var fuente = a.body || a.abstract;
    if (fuente) {
      // Versión de texto, para leer en pantalla o con lector de pantalla.
      contenido.push(el('details', { 'class': 'texto-plano' },
        el('summary', {}, 'Leer como texto'),
        fuente.split(/\n\n+/).map(function (parrafo) { return el('p', {}, parrafo); })
      ));
    }
    if (!contenido.length) contenido.push(el('p', {}, 'Este artículo aún no tiene contenido disponible.'));

    app.replaceChildren(el('main', { 'class': 'contenedor' },
      el('nav', { 'class': 'migas', 'aria-label': 'Ruta' },
        el('a', { href: '/' }, 'Revistas'), ' › ',
        el('a', { href: '/revistas/' + revista }, nombre), ' › Artículo'),
      el('div', { 'class': 'pie-card' }, el('span', { 'class': 'chip' }, a.section ? a.section.name : '')),
      el('h1', { 'class': 'titulo-articulo' }, a.title),
      el('p', { 'class': 'autores' }, (a.authors || []).join(', ')),
      el('p', { 'class': 'meta-revista' },
        el('span', {}, numero),
        el('span', {}, a.start_page ? 'Pág. ' + a.start_page : '')),
      el('div', { 'class': 'acciones-articulo' },
        corazon,
        a.pdf_url ? el('a', { 'class': 'btn', href: a.pdf_url, download: '' }, 'Descargar PDF') : '',
        el('a', { 'class': 'btn btn-borde', href: '/revistas/' + revista }, 'Volver a la revista')),
      el('p', { id: 'aviso', role: 'status' }),
      contenido
    ));
  }

  // ---------- Inicio ----------
  (async function iniciar() {
    leerSesion();
    pintarSesion();
    await cargarFavoritosIds();
    pintarSesion();
    try { await renderizar(); }
    catch (e) { vistaNoEncontrada('Ocurrió un error al cargar la página. Intenta recargarla.'); }
  })();

  // Enlaces a otra revista, artículo o al inicio: se usan enlaces normales, así recargar siempre funciona.
  $('auth-form').addEventListener('submit', enviarAuth);
  $('auth-cerrar').addEventListener('click', function () { $('auth').close(); });
  $('auth-cambiar').addEventListener('click', function () {
    estado.modo = estado.modo === 'login' ? 'register' : 'login';
    $('auth-msg').textContent = '';
    pintarModoAuth();
  });
})();
</script>
</body>
</html>
@endverbatim
