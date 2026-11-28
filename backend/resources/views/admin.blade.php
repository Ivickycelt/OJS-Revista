@verbatim
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Administración | SanColFree</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root { --primario: #1A44D8; --primario-oscuro: #22242A; --acento: #00A087; --fondo: #FDFBF7; --superficie: #EEF2FC; --texto: #22242A; --borde: #CFD8F2; --muted: #5A5F6B; --enlace: #1A44D8; --cabecera: #FFFFFF; --encabezado-tabla: #DCE4F8; }
:root[data-tema="oscuro"] { --primario-oscuro: #FDFBF7; --fondo: #22242A; --superficie: #2b2e37; --texto: #FDFBF7; --borde: #3d414d; --muted: #B9BEC9; --enlace: #00A087; --cabecera: #2b2e37; --encabezado-tabla: #3d414d; }
@media (prefers-color-scheme: dark) {
  :root:not([data-tema="claro"]) { --primario-oscuro: #FDFBF7; --fondo: #22242A; --superficie: #2b2e37; --texto: #FDFBF7; --borde: #3d414d; --muted: #B9BEC9; --enlace: #00A087; --cabecera: #2b2e37; --encabezado-tabla: #3d414d; }
}
* { box-sizing: border-box; }
body { margin: 0; background: var(--fondo); color: var(--primario-oscuro); font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif; -webkit-font-smoothing: antialiased; }
header { background: var(--cabecera); border-bottom: 1px solid var(--borde); padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
header h1 { font-size: 20px; margin: 0; color: var(--primario); }
header a { color: var(--enlace); }
main { padding: 20px; max-width: 1100px; margin: 0 auto; }
h2 { font-size: 18px; margin: 26px 0 10px; color: var(--primario-oscuro); }
.tarjetas { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
.tarjeta { background: var(--superficie); border: 1px solid var(--borde); border-top: 1px solid var(--borde); border-radius: 12px; padding: 16px; box-shadow: 0 6px 18px rgba(34, 36, 42, 0.06); }
.tarjeta .n { font-size: 28px; font-weight: 700; }
.tarjeta .l { color: var(--muted); font-size: 14px; }
table { width: 100%; border-collapse: collapse; background: var(--superficie); border: 1px solid var(--borde); font-size: 14px; }
th, td { padding: 10px; border-bottom: 1px solid var(--borde); text-align: left; vertical-align: top; }
th { background: var(--encabezado-tabla); }
.controles { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; margin-bottom: 12px; }
select, button { color: var(--texto); font-size: 15px; padding: 8px 12px; border-radius: 8px; border: 1px solid var(--borde); background: var(--superficie); }
button { background: var(--primario); color: #fff; border: none; font-weight: 700; cursor: pointer; }
button.tema { background: var(--superficie); color: var(--enlace); border: 1px solid var(--enlace); }
.acciones-cab { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
.log { background: var(--superficie); border: 1px solid var(--borde); border-radius: 12px; padding: 10px; margin-bottom: 8px; font-size: 13px; }
.nivel { display: inline-block; padding: 2px 8px; border-radius: 999px; font-size: 12px; font-weight: 700; background: var(--borde); }
.nivel.ERROR, .nivel.CRITICAL, .nivel.ALERT, .nivel.EMERGENCY { background: #b3261e; color: #fff; }
.nivel.WARNING { background: #f4c542; }
.mensaje { white-space: pre-wrap; word-break: break-word; margin-top: 6px; font-family: monospace; font-size: 12px; color: var(--texto); }
.aviso { background: var(--superficie); border: 1px solid var(--borde); border-left: 4px solid var(--acento); padding: 16px; border-radius: 8px; margin-top: 20px; }
.aviso.error { border-left-color: #b3261e; color: #b3261e; }
.tarjeta, .log, .aviso, table { background: var(--superficie); }
h2 { font-family: "Source Serif 4", Georgia, "Times New Roman", serif; font-size: 1.3rem; }
</style>
</head>
<body>
<header>
  <h1>Panel de administración</h1>
  <div class="acciones-cab"><button id="tema" class="tema" type="button">Modo oscuro</button><a href="/">Volver al portal</a></div>
</header>
<main>
  <div id="aviso" class="aviso" hidden></div>
  <div id="contenido" hidden>
    <h2>Resumen</h2>
    <div class="tarjetas" id="totales"></div>

    <h2>Últimos artículos</h2>
    <div style="overflow-x: auto;">
      <table>
        <thead><tr><th>Título</th><th>Revista</th><th>Sección</th><th>Estado</th></tr></thead>
        <tbody id="ultimos"></tbody>
      </table>
    </div>

    <h2>Registros del sistema (logs)</h2>
    <div class="controles">
      <label>Nivel
        <select id="nivel">
          <option value="">Todos</option>
          <option>ERROR</option>
          <option>WARNING</option>
          <option>INFO</option>
          <option>DEBUG</option>
        </select>
      </label>
      <label>Mostrar
        <select id="limite">
          <option>50</option>
          <option selected>100</option>
          <option>300</option>
        </select>
      </label>
      <button id="actualizar" type="button">Actualizar</button>
    </div>
    <div id="logs"></div>
  </div>
</main>
<script src="/js/particulas.js"></script>
<script>
(function () {
  var guardado = null;
  try { guardado = localStorage.getItem('sc_tema'); } catch (e) {}
  if (guardado === 'claro' || guardado === 'oscuro') document.documentElement.setAttribute('data-tema', guardado);
  function actual() {
    var d = document.documentElement.getAttribute('data-tema');
    if (d) return d;
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oscuro' : 'claro';
  }
  var boton = document.getElementById('tema');
  function pintar() { if (boton) boton.textContent = actual() === 'oscuro' ? 'Modo claro' : 'Modo oscuro'; }
  pintar();
  if (window.iniciarParticulas) window.iniciarParticulas();
  if (boton) boton.addEventListener('click', function () {
    var nuevo = actual() === 'oscuro' ? 'claro' : 'oscuro';
    document.documentElement.setAttribute('data-tema', nuevo);
    try { localStorage.setItem('sc_tema', nuevo); } catch (e) {}
    pintar();
  });
})();
</script>
<script>
(function () {
  var API = location.origin + '/api';
  var aviso = document.getElementById('aviso');
  var contenido = document.getElementById('contenido');

  function mostrarAviso(texto, esError) {
    aviso.textContent = texto;
    aviso.className = 'aviso' + (esError ? ' error' : '');
    aviso.hidden = false;
  }

  var token = null, usuario = null;
  try {
    token = localStorage.getItem('sc_token');
    usuario = JSON.parse(localStorage.getItem('sc_usuario') || 'null');
  } catch (e) { token = null; }

  if (!token || !usuario || usuario.role !== 'admin') {
    mostrarAviso('Esta página es solo para administradores. Inicia sesión como administrador en el portal y vuelve a abrir esta página.', true);
    return;
  }

  function pedir(ruta) {
    return fetch(API + ruta, { headers: { Accept: 'application/json', Authorization: 'Bearer ' + token } })
      .then(function (r) {
        if (r.status === 401 || r.status === 403) throw new Error('Sin permiso. Inicia sesión como administrador.');
        if (!r.ok) throw new Error('Error ' + r.status + ' al consultar el servidor.');
        return r.json();
      });
  }

  function el(tag, attrs, texto) {
    var n = document.createElement(tag);
    if (attrs) Object.keys(attrs).forEach(function (k) { n.setAttribute(k, attrs[k]); });
    if (texto !== undefined) n.textContent = texto;
    return n;
  }

  function cargarMetricas() {
    return pedir('/admin/metricas').then(function (d) {
      var t = d.totales;
      var cont = document.getElementById('totales');
      cont.textContent = '';
      [['Revistas', t.revistas], ['Números', t.numeros], ['Artículos', t.articulos],
       ['Publicados', t.articulos_publicados], ['Usuarios', t.usuarios], ['Favoritos', t.favoritos]]
        .forEach(function (p) {
          var c = el('div', { 'class': 'tarjeta' });
          c.appendChild(el('div', { 'class': 'n' }, String(p[1])));
          c.appendChild(el('div', { 'class': 'l' }, p[0]));
          cont.appendChild(c);
        });

      var tb = document.getElementById('ultimos');
      tb.textContent = '';
      if (!d.ultimos_articulos.length) {
        var vacia = el('tr');
        vacia.appendChild(el('td', { colspan: '4' }, 'Todavía no hay artículos.'));
        tb.appendChild(vacia);
      }
      d.ultimos_articulos.forEach(function (a) {
        var f = el('tr');
        f.appendChild(el('td', null, a.title || ''));
        f.appendChild(el('td', null, a.revista || ''));
        f.appendChild(el('td', null, a.seccion || ''));
        f.appendChild(el('td', null, a.publicado ? 'Publicado' : 'No publicado'));
        tb.appendChild(f);
      });
    });
  }

  function cargarLogs() {
    var nivel = document.getElementById('nivel').value;
    var limite = document.getElementById('limite').value;
    var ruta = '/admin/logs?limite=' + encodeURIComponent(limite) + (nivel ? '&nivel=' + encodeURIComponent(nivel) : '');
    return pedir(ruta).then(function (d) {
      var cont = document.getElementById('logs');
      cont.textContent = '';
      if (!d.data.length) {
        cont.appendChild(el('p', null, 'No hay registros con ese filtro.'));
        return;
      }
      d.data.forEach(function (e) {
        var caja = el('div', { 'class': 'log' });
        var cab = el('div');
        cab.appendChild(el('span', { 'class': 'nivel ' + e.nivel }, e.nivel));
        cab.appendChild(document.createTextNode('  ' + e.fecha));
        caja.appendChild(cab);
        caja.appendChild(el('div', { 'class': 'mensaje' }, e.mensaje));
        cont.appendChild(caja);
      });
    });
  }

  function manejarError(err) { mostrarAviso(err.message, true); }

  document.getElementById('actualizar').addEventListener('click', function () { cargarLogs().catch(manejarError); });
  document.getElementById('nivel').addEventListener('change', function () { cargarLogs().catch(manejarError); });
  document.getElementById('limite').addEventListener('change', function () { cargarLogs().catch(manejarError); });

  Promise.all([cargarMetricas(), cargarLogs()])
    .then(function () { contenido.hidden = false; })
    .catch(manejarError);
})();
</script>
</body>
</html>
@endverbatim
