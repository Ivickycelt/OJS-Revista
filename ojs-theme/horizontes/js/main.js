// SanColFree - aparición suave de tarjetas al hacer scroll
(function () {
  'use strict';

  // Si la persona pidió "reducir movimiento", no animamos nada.
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    return;
  }
  // Navegadores muy viejos: mejor no animar que romper la página.
  if (!('IntersectionObserver' in window)) {
    return;
  }

  var elementos = document.querySelectorAll(
    '.obj_article_summary, .obj_issue_summary, .cmp_article_list > li'
  );
  if (!elementos.length) {
    return;
  }

  var observador = new IntersectionObserver(function (entradas) {
    entradas.forEach(function (entrada) {
      if (entrada.isIntersecting) {
        entrada.target.classList.add('hz-visible');
        observador.unobserve(entrada.target);
      }
    });
  }, { threshold: 0.1 });

  elementos.forEach(function (el) {
    el.classList.add('hz-reveal');
    observador.observe(el);
  });
})();
