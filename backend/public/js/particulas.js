// Partículas de fondo de SanColFr (código propio, sin licencias).
// window.iniciarParticulas() crea un lienzo fijo detrás de la página
// y un botón para pausar o reanudar la animación (se recuerda en el navegador).
(function () {
  var colores = ['#1A44D8', '#00A087'];
  var clave = 'sc_fondo';

  function leerPausa() {
    try { return localStorage.getItem(clave) === 'pausado'; } catch (e) { return false; }
  }
  function guardarPausa(valor) {
    try { localStorage.setItem(clave, valor ? 'pausado' : 'activo'); } catch (e) { /* sin almacenamiento */ }
  }

  window.iniciarParticulas = function () {
    if (document.getElementById('particulas')) return;

    var c = document.createElement('canvas');
    c.id = 'particulas';
    c.setAttribute('aria-hidden', 'true');
    c.style.cssText = 'position:fixed;inset:0;z-index:-1;pointer-events:none;';
    document.body.prepend(c);
    var ctx = c.getContext('2d');

    var ancho = 0, alto = 0, puntos = [], t = 0;
    var raton = { x: -9999, y: -9999 };
    var pausado = leerPausa();

    var boton = document.createElement('button');
    boton.id = 'fondo-control';
    boton.type = 'button';
    boton.style.cssText = 'position:fixed;right:16px;bottom:16px;z-index:50;padding:9px 16px;border-radius:999px;' +
      'border:1px solid #00A087;background:var(--superficie);color:var(--texto);' +
      'font:600 13px/1 Inter,system-ui,sans-serif;cursor:pointer;box-shadow:0 6px 18px rgba(0,0,0,.18);';
    function pintarBoton() {
      boton.textContent = pausado ? 'Reanudar fondo' : 'Pausar fondo';
      boton.setAttribute('aria-pressed', pausado ? 'true' : 'false');
    }
    boton.addEventListener('click', function () {
      pausado = !pausado;
      guardarPausa(pausado);
      pintarBoton();
    });
    pintarBoton();
    document.body.appendChild(boton);

    function crear() {
      var n = Math.min(70, Math.floor(ancho * alto / 18000));
      puntos = [];
      for (var i = 0; i < n; i++) {
        puntos.push({
          x: Math.random() * ancho,
          y: Math.random() * alto,
          vx: (Math.random() - 0.5) * 1.6,
          vy: (Math.random() - 0.5) * 1.6,
          r: 1.2 + Math.random() * 2.2,
          fase: Math.random() * Math.PI * 2,
          color: colores[i % 2]
        });
      }
    }

    function ajustar() {
      var dpr = Math.min(window.devicePixelRatio || 1, 1.5);
      ancho = window.innerWidth;
      alto = window.innerHeight;
      c.width = ancho * dpr;
      c.height = alto * dpr;
      c.style.width = ancho + 'px';
      c.style.height = alto + 'px';
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
      crear();
      dibujar();
    }

    function mover() {
      t += 0.02;
      for (var i = 0; i < puntos.length; i++) {
        var p = puntos[i];
        p.x += p.vx + Math.sin(t + p.fase) * 0.45;
        p.y += p.vy + Math.cos(t + p.fase) * 0.45;
        var dx = p.x - raton.x, dy = p.y - raton.y;
        var d = Math.sqrt(dx * dx + dy * dy);
        if (d > 0 && d < 120) {
          p.x += (dx / d) * (120 - d) * 0.04;
          p.y += (dy / d) * (120 - d) * 0.04;
        }
        if (p.x < -10) p.x = ancho + 10;
        if (p.x > ancho + 10) p.x = -10;
        if (p.y < -10) p.y = alto + 10;
        if (p.y > alto + 10) p.y = -10;
      }
    }

    function dibujar() {
      ctx.clearRect(0, 0, ancho, alto);
      var distancia = 140;
      ctx.lineWidth = 1;
      ctx.strokeStyle = '#1A44D8';
      for (var a = 0; a < puntos.length; a++) {
        for (var b = a + 1; b < puntos.length; b++) {
          var dx = puntos[a].x - puntos[b].x, dy = puntos[a].y - puntos[b].y;
          var d2 = dx * dx + dy * dy;
          if (d2 < distancia * distancia) {
            var d = Math.sqrt(d2);
            ctx.globalAlpha = (1 - d / distancia) * 0.22;
            ctx.beginPath();
            ctx.moveTo(puntos[a].x, puntos[a].y);
            ctx.lineTo(puntos[b].x, puntos[b].y);
            ctx.stroke();
          }
        }
      }
      for (var k = 0; k < puntos.length; k++) {
        var s = puntos[k];
        var r = s.r * (1 + 0.25 * Math.sin(t * 2 + s.fase));
        ctx.globalAlpha = 0.6;
        ctx.fillStyle = s.color;
        ctx.beginPath();
        ctx.arc(s.x, s.y, r, 0, Math.PI * 2);
        ctx.fill();
      }
      ctx.globalAlpha = 1;
    }

    function bucle() {
      if (!pausado) {
        mover();
        dibujar();
      }
      requestAnimationFrame(bucle);
    }

    window.addEventListener('pointermove', function (e) { raton.x = e.clientX; raton.y = e.clientY; });
    window.addEventListener('resize', ajustar);
    ajustar();
    requestAnimationFrame(bucle);
  };
})();
