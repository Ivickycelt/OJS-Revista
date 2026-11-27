@verbatim
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Revistas | SanColFr</title>
<meta name="description" content="SanColFr, plataforma de revistas digitales de acceso abierto.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400..700&family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&display=swap" rel="stylesheet">
<style>
/* ================= Tokens: paleta SanColFr y sus tonos ================= */
:root {
  --papel: #FDFBF7;
  --papel-hondo: #F4F0E7;
  --superficie: #EEF2FC;
  --tinta: #22242A;
  --texto: #22242A;
  --muted: #5B606C;
  --linea: #D2DAF0;
  --azul: #1A44D8;
  --azul-boton: #1A44D8;
  --azul-hondo: #12329E;
  --azul-tinta: #E9EEFD;
  --verde: #00A087;
  --verde-hondo: #00705F;
  --menta: #DCF2EC;
  --logo-san: #22242A;
  --logo-col: #1A44D8;
  --sombra: 0 1px 0 rgba(34, 36, 42, 0.04), 0 16px 30px -22px rgba(34, 36, 42, 0.45);
  --ease: cubic-bezier(0.2, 0.8, 0.2, 1);
}
@media (prefers-color-scheme: dark) {
  :root:not([data-tema="claro"]) {
    --papel: #17191E;
    --papel-hondo: #1E2128;
    --superficie: #22252D;
    --tinta: #F4F1EA;
    --texto: #EDEAE2;
    --muted: #A9AFBB;
    --linea: #353945;
    --azul: #7C98FF;
    --azul-boton: #1A44D8;
    --azul-hondo: #0E2A8A;
    --azul-tinta: #1D2745;
    --verde: #2BC4A7;
    --verde-hondo: #7FE3CF;
    --menta: #14332D;
    --logo-san: #FDFBF7;
    --logo-col: #00A087;
    --sombra: 0 1px 0 rgba(0, 0, 0, 0.3), 0 18px 34px -20px rgba(0, 0, 0, 0.7);
  }
}
:root[data-tema="oscuro"] {
  --papel: #17191E;
  --papel-hondo: #1E2128;
  --superficie: #22252D;
  --tinta: #F4F1EA;
  --texto: #EDEAE2;
  --muted: #A9AFBB;
  --linea: #353945;
  --azul: #7C98FF;
  --azul-boton: #1A44D8;
  --azul-hondo: #0E2A8A;
  --azul-tinta: #1D2745;
  --verde: #2BC4A7;
  --verde-hondo: #7FE3CF;
  --menta: #14332D;
  --logo-san: #FDFBF7;
  --logo-col: #00A087;
  --sombra: 0 1px 0 rgba(0, 0, 0, 0.3), 0 18px 34px -20px rgba(0, 0, 0, 0.7);
}

/* ================= Base ================= */
* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  margin: 0;
  font-family: "Geist", system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  font-size: 16px;
  line-height: 1.6;
  color: var(--texto);
  background-color: var(--papel);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='180'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='2' stitchTiles='stitch'/%3E%3CfeColorMatrix values='0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 .07 0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  -webkit-font-smoothing: antialiased;
}
a { color: var(--azul); text-underline-offset: 4px; }
button, a { -webkit-tap-highlight-color: transparent; }
:focus-visible { outline: 2px solid var(--verde); outline-offset: 3px; border-radius: 4px; }
.contenedor { max-width: 1120px; margin: 0 auto; padding: 0 20px; }
section[id], #texto { scroll-margin-top: 90px; }

/* Ondas al presionar */
.onda {
  position: absolute;
  border-radius: 50%;
  background: currentColor;
  opacity: 0.22;
  transform: scale(0);
  animation: onda 0.65s var(--ease) forwards;
  pointer-events: none;
}
@keyframes onda { to { transform: scale(1); opacity: 0; } }
@keyframes subir { to { opacity: 1; transform: none; } }
@keyframes entrar { from { opacity: 0; transform: translateY(16px); } }
@keyframes pulso {
  0% { box-shadow: 0 0 0 0 rgba(0, 160, 135, 0.55); }
  100% { box-shadow: 0 0 0 9px rgba(0, 160, 135, 0); }
}
@keyframes brillo { from { background-position: 200% 0; } to { background-position: -200% 0; } }
@keyframes latido { 0% { transform: scale(1); } 40% { transform: scale(1.35); } 100% { transform: scale(1); } }
@keyframes anillo { from { transform: scale(0.5); opacity: 0.9; } to { transform: scale(2); opacity: 0; } }
@keyframes aparecerDialogo { from { opacity: 0; transform: translateY(12px) scale(0.98); } }

/* Transición del cambio de tema: un círculo que se expande desde el botón */
::view-transition-old(root), ::view-transition-new(root) { animation: none; mix-blend-mode: normal; }

/* ================= Encabezado ================= */
.cabecera {
  position: sticky;
  top: 0;
  z-index: 10;
  background: color-mix(in srgb, var(--papel) 88%, transparent);
  backdrop-filter: blur(10px) saturate(1.2);
  -webkit-backdrop-filter: blur(10px) saturate(1.2);
  border-bottom: 1px solid var(--linea);
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
.logo { display: inline-block; line-height: 0; transition: transform 0.4s var(--ease); }
.logo:hover { transform: rotate(-3deg); }
.logo svg { display: block; width: 260px; max-width: 100%; height: auto; }
.logo-san { fill: var(--logo-san); }
.logo-col { fill: var(--logo-col); }
.acciones { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.saludo { color: var(--tinta); font-weight: 600; font-size: 0.92rem; }

/* ================= Botones ================= */
.btn {
  position: relative;
  overflow: hidden;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: var(--azul-boton);
  color: #ffffff;
  border: 1px solid var(--azul-boton);
  border-radius: 8px;
  padding: 10px 18px;
  font: inherit;
  font-weight: 600;
  font-size: 0.94rem;
  cursor: pointer;
  text-decoration: none;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.14), 0 8px 18px -12px rgba(26, 68, 216, 0.9);
  transition: transform 0.15s var(--ease), background-color 0.25s, border-color 0.25s, box-shadow 0.25s, color 0.25s;
}
.btn:hover { background: var(--azul-hondo); border-color: var(--azul-hondo); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.14), 0 12px 22px -12px rgba(18, 50, 158, 0.9); }
.btn:active { transform: scale(0.96); box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.25); }
.btn-borde {
  background: transparent;
  color: var(--tinta);
  border-color: var(--linea);
  box-shadow: none;
}
.btn-borde:hover { background: var(--azul-tinta); color: var(--azul); border-color: color-mix(in srgb, var(--azul) 45%, var(--linea)); box-shadow: none; }
.btn-acento { background: var(--verde); border-color: var(--verde); color: #0B1F1A; box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 8px 18px -12px rgba(0, 160, 135, 0.9); }
.btn-acento:hover { background: var(--verde); border-color: var(--verde); color: #0B1F1A; filter: brightness(0.94); }
.btn[hidden] { display: none; }
#tema { min-width: 118px; }

/* ================= Portada ================= */
.portada {
  position: relative;
  overflow: hidden;
  background: linear-gradient(160deg, var(--azul-hondo) 0%, var(--azul-boton) 72%);
  color: #FDFBF7;
  padding: 76px 0 70px;
}
.portada::before {
  content: "";
  position: absolute;
  right: -150px;
  top: -190px;
  width: 560px;
  height: 560px;
  border-radius: 50%;
  border: 1px solid rgba(253, 251, 247, 0.16);
  box-shadow: 0 0 0 70px rgba(253, 251, 247, 0.03), 0 0 0 140px rgba(253, 251, 247, 0.025);
  pointer-events: none;
}
.portada::after {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 4px;
  background: var(--verde);
}
.portada .contenedor { position: relative; }
.portada-inicio {
  background: none;
  color: var(--tinta);
  padding: 72px 0 40px;
}
.portada-inicio::before, .portada-inicio::after { display: none; }
.portada h1 {
  margin: 0 0 14px;
  padding-bottom: 0.08em;
  font-family: "Newsreader", Georgia, "Times New Roman", serif;
  font-weight: 500;
  font-size: clamp(3.2rem, 11vw, 7.2rem);
  line-height: 0.98;
  letter-spacing: -0.035em;
}
.portada-inicio h1 { color: var(--tinta); }
.palabra {
  display: inline-block;
  opacity: 0;
  transform: translateY(0.45em);
  animation: subir 0.95s var(--ease) forwards;
  animation-delay: calc(var(--i, 0) * 110ms + 80ms);
}
.portada p { margin: 0 0 16px; max-width: 620px; font-size: 1.12rem; opacity: 0.94; }
.portada-inicio p { color: var(--muted); opacity: 1; font-size: 1.14rem; }
.insignia {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(253, 251, 247, 0.1);
  color: #FDFBF7;
  border: 1px solid rgba(253, 251, 247, 0.3);
  border-radius: 999px;
  padding: 5px 13px;
  margin-bottom: 18px;
  font-size: 0.86rem;
  font-weight: 500;
}
.insignia::before {
  content: "";
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #2BE0BF;
}
.portada .meta-portada { margin-top: 10px; font-size: 0.95rem; opacity: 0.9; display: flex; gap: 6px 18px; flex-wrap: wrap; }
.buscador-portada {
  display: flex;
  gap: 8px;
  margin-top: 30px;
  max-width: 640px;
  padding: 6px;
  flex-wrap: wrap;
  background: var(--superficie);
  border: 1px solid var(--linea);
  border-radius: 999px;
  box-shadow: var(--sombra);
  transition: border-color 0.3s, box-shadow 0.3s;
}
.buscador-portada:focus-within {
  border-color: var(--verde);
  box-shadow: 0 0 0 5px color-mix(in srgb, var(--verde) 22%, transparent), var(--sombra);
}
.buscador-portada input {
  flex: 1 1 240px;
  min-width: 0;
  padding: 12px 18px;
  border: 0;
  background: transparent;
  color: var(--tinta);
  font: inherit;
  font-size: 1rem;
  outline: none;
}
.buscador-portada input::placeholder { color: var(--muted); }

/* ================= Controles de la revista ================= */
.controles { padding: 30px 0 6px; }
.fila { display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }
#buscar {
  flex: 1 1 260px;
  padding: 10px 2px;
  border: 0;
  border-bottom: 1px solid var(--linea);
  border-radius: 0;
  background: linear-gradient(var(--verde), var(--verde)) left bottom / 0 2px no-repeat;
  color: var(--tinta);
  font: inherit;
  font-size: 1rem;
  transition: background-size 0.45s var(--ease);
}
#buscar::placeholder { color: var(--muted); }
#buscar:focus { outline: none; background-size: 100% 2px; }
#selector-numero {
  flex: 0 1 280px;
  padding: 10px 12px;
  border: 1px solid var(--linea);
  border-radius: 8px;
  font: inherit;
  color: var(--tinta);
  background: var(--superficie);
}
.chips { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 16px; }
.filtro {
  position: relative;
  overflow: hidden;
  border: 1px solid var(--linea);
  background: var(--superficie);
  color: var(--tinta);
  border-radius: 999px;
  padding: 6px 15px;
  font: inherit;
  font-size: 0.9rem;
  cursor: pointer;
  transition: transform 0.15s var(--ease), background-color 0.25s, color 0.25s, border-color 0.25s;
}
.filtro:hover { border-color: var(--azul); color: var(--azul); }
.filtro:active { transform: scale(0.94); }
.filtro.activo { background: var(--tinta); border-color: var(--tinta); color: var(--papel); }
#aviso { min-height: 1.4em; color: #A33A00; font-weight: 600; margin: 10px 0 0; }
.subtitulo {
  font-family: "Newsreader", Georgia, serif;
  font-weight: 500;
  font-size: 2rem;
  letter-spacing: -0.02em;
  color: var(--tinta);
  margin: 46px 0 4px;
}

/* ================= Dashboard (cifras con filetes, sin cajas) ================= */
.dashboard { margin: 0; }
.dash-tarjetas {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
  border-top: 1px solid var(--linea);
  border-bottom: 1px solid var(--linea);
}
.dash-tarjeta { padding: 22px 22px 20px; border-left: 1px solid var(--linea); }
.dash-tarjeta:first-child { border-left: 0; padding-left: 0; }
.dash-n {
  font-family: "Newsreader", Georgia, serif;
  font-size: clamp(2.4rem, 5vw, 3.4rem);
  font-weight: 500;
  line-height: 1;
  letter-spacing: -0.02em;
  color: var(--azul);
  font-variant-numeric: tabular-nums;
}
.dash-l { color: var(--muted); font-size: 0.9rem; margin-top: 8px; }
.dash-resumen {
  font-family: "Newsreader", Georgia, serif;
  font-size: clamp(1.4rem, 3vw, 1.9rem);
  line-height: 1.35;
  letter-spacing: -0.01em;
  color: var(--tinta);
  margin: 40px 0 0;
  max-width: 30ch;
}
.dash-titulo {
  font-family: "Newsreader", Georgia, serif;
  font-size: 1.7rem;
  font-weight: 500;
  letter-spacing: -0.01em;
  margin: 46px 0 6px;
  color: var(--tinta);
}
.dash-lista { list-style: none; padding: 0; margin: 0; }
.dash-lista li {
  border-bottom: 1px solid var(--linea);
  padding: 14px 0;
  transition: padding-left 0.35s var(--ease);
}
.dash-lista li:hover { padding-left: 12px; }
.dash-lista a {
  font-family: "Newsreader", Georgia, serif;
  font-size: 1.22rem;
  font-weight: 500;
  color: var(--tinta);
  text-decoration: none;
  background-image: linear-gradient(var(--azul), var(--azul));
  background-size: 0 1px;
  background-position: 0 100%;
  background-repeat: no-repeat;
  transition: background-size 0.4s var(--ease), color 0.2s;
}
.dash-lista li:hover a { background-size: 100% 1px; color: var(--azul); }
.dash-lista .meta-revista { margin-left: 12px; }

/* ================= Tapas de revistas y artículos ================= */
.rejilla {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 22px;
  padding: 22px 0 8px;
}
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 22px 22px 20px 28px;
  background: var(--superficie);
  border: 1px solid var(--linea);
  border-radius: 4px;
  box-shadow: var(--sombra);
  cursor: pointer;
  overflow: hidden;
  animation: entrar 0.75s var(--ease) backwards;
  animation-delay: calc(var(--i, 0) * 75ms + 160ms);
  transition: transform 0.4s var(--ease), box-shadow 0.4s var(--ease), border-color 0.3s;
}
.card::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 6px;
  background: var(--banda, var(--azul));
  transition: width 0.4s var(--ease);
}
.card:hover, .card:focus-within {
  transform: translateY(-4px);
  box-shadow: 0 26px 40px -26px rgba(34, 36, 42, 0.55);
  border-color: color-mix(in srgb, var(--banda, var(--azul)) 38%, var(--linea));
}
.card:hover::before, .card:focus-within::before { width: 12px; }
.card:active { transform: translateY(-1px) scale(0.99); }
.card h3 { margin: 0; font-family: "Newsreader", Georgia, serif; font-size: 1.36rem; font-weight: 600; line-height: 1.2; letter-spacing: -0.01em; color: var(--tinta); }
.card h3 a { color: inherit; text-decoration: none; }
.card h3 a::after { content: ""; position: absolute; inset: 0; }
.card h3 a:focus { outline: none; }
.card:focus-within { outline: none; }
.autores { margin: 0; color: var(--muted); font-size: 0.93rem; }
.meta-revista { color: var(--muted); font-size: 0.9rem; margin: 0; display: flex; gap: 6px 14px; flex-wrap: wrap; }
.pie-card { margin-top: auto; display: flex; justify-content: space-between; align-items: center; color: var(--muted); font-size: 0.88rem; }
.chip {
  align-self: flex-start;
  background: var(--menta);
  color: var(--verde-hondo);
  border-radius: 999px;
  padding: 3px 11px;
  font-size: 0.78rem;
  font-weight: 600;
}
.portada-tarjeta {
  display: block;
  width: calc(100% + 50px);
  max-width: none;
  margin: -22px -22px 10px -28px;
  height: 200px;
  object-fit: cover;
  object-position: top;
  background: var(--papel-hondo);
  border-bottom: 1px solid var(--linea);
}
.fav {
  position: relative;
  z-index: 2;
  border: 0;
  background: transparent;
  font-size: 1.4rem;
  line-height: 1;
  color: var(--muted);
  cursor: pointer;
  padding: 6px 8px;
  border-radius: 999px;
  transition: transform 0.15s var(--ease), color 0.25s, background-color 0.25s;
}
.fav:hover { color: var(--verde); background: var(--menta); }
.fav:active { transform: scale(0.8); }
.fav.activo { color: var(--verde); }
.fav.pop { animation: latido 0.45s var(--ease); }
.fav.pop::after {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 999px;
  border: 2px solid var(--verde);
  animation: anillo 0.6s var(--ease) forwards;
  pointer-events: none;
}
.vacio { grid-column: 1 / -1; text-align: center; color: var(--muted); padding: 34px 0; font-family: "Newsreader", Georgia, serif; font-size: 1.2rem; }
.mas { display: block; margin: 22px auto 40px; }

/* Esqueletos de carga */
.esqueleto {
  border-radius: 4px;
  background: linear-gradient(90deg, var(--papel-hondo) 25%, var(--linea) 50%, var(--papel-hondo) 75%);
  background-size: 200% 100%;
  animation: brillo 1.5s linear infinite;
  margin-bottom: 10px;
}
.esqueleto-tarjeta { pointer-events: none; min-height: 170px; animation: none; }

/* ================= Ventanas ================= */
dialog {
  max-height: 88vh;
  overflow-y: auto;
  border: 1px solid var(--linea);
  border-radius: 8px;
  padding: 0;
  width: calc(100% - 32px);
  max-width: 440px;
  background: var(--superficie);
  color: var(--texto);
  box-shadow: 0 34px 80px -24px rgba(0, 0, 0, 0.55);
}
dialog[open] { animation: aparecerDialogo 0.4s var(--ease) backwards; }
dialog::backdrop { background: rgba(20, 22, 28, 0.55); animation: entrar 0.3s ease backwards; }
#detalle { max-width: 940px; }
.dlg { padding: 30px 28px 24px; }
.dlg h2 { margin: 4px 0 12px; font-family: "Newsreader", Georgia, serif; font-weight: 500; font-size: 1.7rem; color: var(--tinta); }
.dlg label { display: block; margin: 14px 0 4px; font-weight: 600; font-size: 0.88rem; color: var(--muted); }
.dlg input {
  width: 100%;
  padding: 10px 2px;
  border: 0;
  border-bottom: 1px solid var(--linea);
  border-radius: 0;
  background: linear-gradient(var(--verde), var(--verde)) left bottom / 0 2px no-repeat;
  color: var(--tinta);
  font: inherit;
  transition: background-size 0.45s var(--ease);
}
.dlg input:focus { outline: none; background-size: 100% 2px; }
.dlg .botones { display: flex; gap: 10px; margin-top: 22px; flex-wrap: wrap; }
.enlace { background: none; border: 0; color: var(--azul); text-decoration: underline; cursor: pointer; font: inherit; padding: 0; margin-top: 16px; }
#auth-msg { color: #A33A00; font-weight: 600; min-height: 1.3em; }
.visor-pdf {
  display: block;
  width: 100%;
  height: 74vh;
  min-height: 420px;
  border: 1px solid var(--linea);
  border-radius: 4px;
  margin: 14px 0;
  background: var(--papel-hondo);
}
.texto-plano { margin-top: 14px; }
.texto-plano summary { cursor: pointer; color: var(--azul); font-weight: 600; }
.meta { color: var(--muted); font-size: 0.92rem; }

/* ================= Pie ================= */
.pie {
  background: #22242A;
  color: #D9DCE3;
  margin-top: 80px;
  padding: 52px 0 28px;
  font-size: 0.92rem;
}
.pie .rejilla-pie { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 28px; }
.pie strong { font-family: "Newsreader", Georgia, serif; color: #FDFBF7; font-size: 1.3rem; font-weight: 500; }
.pie a { color: #2BE0BF; }
.pie p { margin: 6px 0; }
.pie .legal { margin-top: 30px; padding-top: 18px; border-top: 1px solid rgba(255, 255, 255, 0.12); font-size: 0.82rem; opacity: 0.75; }

/* ================= Migas ================= */
.migas { padding: 22px 0 0; font-size: 0.88rem; color: var(--muted); }
.migas a { color: var(--azul); }

/* ================= Barra de progreso de lectura ================= */
#progreso {
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  height: 3px;
  z-index: 30;
  transform-origin: 0 50%;
  transform: scaleX(0);
  background: linear-gradient(90deg, var(--azul), var(--verde));
}

/* ================= Artículo ================= */
.articulo { max-width: 720px; padding-bottom: 24px; }
.titulo-articulo {
  font-family: "Newsreader", Georgia, serif;
  color: var(--tinta);
  font-size: clamp(2.2rem, 5.4vw, 3.4rem);
  line-height: 1.05;
  letter-spacing: -0.025em;
  font-weight: 600;
  margin: 10px 0 14px;
}
.seccion-articulo { font-size: 0.9rem; font-weight: 600; color: var(--verde-hondo); margin: 30px 0 4px; }
.autores-articulo { font-size: 1.05rem; color: var(--texto); margin: 0 0 6px; font-weight: 600; }
.datos-articulo {
  display: flex;
  flex-wrap: wrap;
  gap: 6px 18px;
  font-size: 0.9rem;
  color: var(--muted);
  margin: 0 0 14px;
  padding-bottom: 18px;
  border-bottom: 1px solid var(--linea);
}
.acciones-articulo { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin: 18px 0 30px; }
.acciones-articulo .btn { text-decoration: none; }
.fav-grande { border: 1px solid var(--linea); border-radius: 999px; background: var(--superficie); font-size: 1.4rem; padding: 6px 14px; }
.fav-grande.activo { border-color: var(--verde); }
.articulo section h2 {
  font-family: "Newsreader", Georgia, serif;
  font-weight: 500;
  font-size: 1.6rem;
  letter-spacing: -0.01em;
  color: var(--tinta);
  margin: 40px 0 12px;
}
.bloque-resumen {
  background: var(--azul-tinta);
  border-radius: 4px;
  padding: 22px 26px 24px;
  position: relative;
}
.bloque-resumen::before {
  content: "";
  position: absolute;
  left: 0;
  top: 22px;
  bottom: 22px;
  width: 3px;
  background: var(--verde);
}
.bloque-resumen h2 { margin: 0 0 8px !important; font-size: 1.05rem !important; font-family: "Geist", system-ui, sans-serif !important; font-weight: 600 !important; color: var(--azul) !important; }
.bloque-resumen p { font-family: "Newsreader", Georgia, serif; font-size: 1.2rem; line-height: 1.65; margin: 0; color: var(--texto); }
.texto-articulo p {
  font-family: "Newsreader", Georgia, serif;
  font-size: 1.22rem;
  line-height: 1.8;
  color: var(--texto);
  margin: 0 0 1.1em;
  max-width: 66ch;
}
.texto-articulo p:first-of-type::first-letter {
  float: left;
  font-size: 4.3rem;
  line-height: 0.82;
  padding: 8px 12px 0 0;
  font-weight: 600;
  color: var(--azul);
}
.pdf-articulo { margin-top: 36px; }
.articulo .volver { margin: 34px 0 0; }
@media print { .cabecera, .acciones-articulo, .migas, .pie, .volver, .visor-pdf, #progreso { display: none !important; } }

/* ================= Movimiento reducido: se respeta, sin quitar el contenido ================= */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.001ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.001ms !important;
    scroll-behavior: auto !important;
  }
}

/* ================= Móvil ================= */
@media (max-width: 680px) {
  .portada { padding: 52px 0 48px; }
  .portada-inicio { padding: 48px 0 28px; }
  .rejilla { grid-template-columns: 1fr; }
  .dash-tarjetas { grid-template-columns: repeat(auto-fit, minmax(96px, 1fr)); }
  .dash-tarjeta { padding: 16px 12px 14px; }
  .dash-tarjeta:first-child { padding-left: 0; }
  .visor-pdf { height: 60vh; min-height: 320px; }
  .buscador-portada { border-radius: 18px; }
  .buscador-portada .btn { width: 100%; }
  .acciones-articulo .btn { flex: 1 1 auto; }
}
</style>
</head>
<body>

<header class="cabecera">
  <div class="contenedor">
    <a href="/" aria-label="Inicio del portal SanColFr" class="logo">
      <svg xmlns="http://www.w3.org/2000/svg" width="300" height="64" viewBox="0 0 300 64" role="img" aria-label="SanColFr">
        <rect x="0" y="0" width="64" height="64" rx="14" fill="#1A44D8"/>
        <path d="M16 38 A16 16 0 0 1 48 38 Z" fill="#FFFFFF"/>
        <rect x="10" y="40" width="44" height="4" rx="2" fill="#00A087"/>
        <text class="logo-san" x="80" y="46" font-family="Arial, Helvetica, sans-serif" font-size="40" font-weight="700">San</text>
        <text class="logo-col" x="153" y="46" font-family="Arial, Helvetica, sans-serif" font-size="40" font-weight="700">ColFr</text>
      </svg>
    </a>
    <div class="acciones"><div id="sesion" class="acciones"></div><button id="tema" class="btn btn-borde" type="button">Modo oscuro</button></div>
  </div>
</header>

<div id="app">
  <noscript><p class="contenedor">Esta página necesita JavaScript para mostrar las revistas y los artículos.</p></noscript>
</div>

<footer class="pie">
  <div class="contenedor rejilla-pie">
    <div>
      <p><strong>SanColFr</strong></p>
      <p>Plataforma de revistas digitales de acceso abierto.</p>
    </div>
    <div>
      <p><strong>Explora</strong></p>
      <p><a href="/">Todas las revistas</a></p>
    </div>
    <div>
      <p><strong>Acceso abierto</strong></p>
      <p>Los artículos se publican para que cualquier persona pueda leerlos sin costo.</p>
    </div>
  </div>
  <div class="contenedor legal">
    <p>© 2026 SanColFr. Los artículos pertenecen a sus autores y a las revistas que los publican.</p>
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

<script src="/js/particulas.js"></script>
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
  var reducirMovimiento = function () {
    return !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);
  };

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
  function plural(n, uno, varios) {
    return n + ' ' + (n === 1 ? uno : varios);
  }
  function etiquetaNumero(n) {
    return 'Vol. ' + n.volume + ', Núm. ' + n.number + ' (' + n.year + ')';
  }

  // Título que entra palabra por palabra (la animación de entrada de la portada).
  function titulo(texto, etiqueta) {
    var h = el(etiqueta || 'h1', { 'aria-label': texto });
    texto.split(' ').forEach(function (palabra, i) {
      if (i) h.append(' ');
      h.append(el('span', { 'class': 'palabra', style: '--i:' + i, 'aria-hidden': 'true' }, palabra));
    });
    return h;
  }

  // ---------- Sesión (el token se guarda en el navegador) ----------
  function leerSesion() {
    try {
      estado.token = localStorage.getItem('sc_token');
      var u = localStorage.getItem('sc_usuario');
      estado.usuario = u ? JSON.parse(u) : null;
    } catch (e) { estado.token = null; estado.usuario = null; }
  }
  function guardarSesion(token, usuario) {
    estado.token = token; estado.usuario = usuario;
    try {
      if (token) {
        localStorage.setItem('sc_token', token);
        localStorage.setItem('sc_usuario', JSON.stringify(usuario));
      } else {
        localStorage.removeItem('sc_token');
        localStorage.removeItem('sc_usuario');
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

  // ---------- Efecto de onda al presionar botones ----------
  function ondaAlPresionar(e) {
    var b = e.target.closest && e.target.closest('.btn, .filtro');
    if (!b || b.disabled || reducirMovimiento()) return;
    var r = b.getBoundingClientRect();
    var d = Math.max(r.width, r.height) * 2.2;
    var onda = el('span', {
      'class': 'onda', 'aria-hidden': 'true',
      style: 'width:' + d + 'px;height:' + d + 'px;left:' + (e.clientX - r.left - d / 2) + 'px;top:' + (e.clientY - r.top - d / 2) + 'px'
    });
    b.append(onda);
    onda.addEventListener('animationend', function () { onda.remove(); });
  }

  // ---------- Barra de progreso de lectura (solo en artículos) ----------
  var progreso = null;
  function actualizarProgreso() {
    if (!progreso) return;
    var alto = document.documentElement.scrollHeight - window.innerHeight;
    var p = alto > 0 ? Math.min(window.scrollY / alto, 1) : 0;
    progreso.style.transform = 'scaleX(' + p + ')';
  }
  function activarProgreso() {
    if (progreso) return;
    progreso = el('div', { id: 'progreso', 'aria-hidden': 'true' });
    document.body.append(progreso);
    window.addEventListener('scroll', actualizarProgreso, { passive: true });
    actualizarProgreso();
  }
  function quitarProgreso() {
    if (!progreso) return;
    window.removeEventListener('scroll', actualizarProgreso);
    progreso.remove();
    progreso = null;
  }

  // ---------- Encabezado y sesión ----------
  function pintarSesion() {
    var caja = $('sesion');
    if (!caja) return;
    caja.replaceChildren();
    if (estado.usuario) {
      caja.append(el('span', { 'class': 'saludo' }, 'Hola, ' + estado.usuario.name));
      if (estado.usuario.role === 'admin') caja.append(el('a', { 'class': 'btn btn-borde', href: '/admin' }, 'Administración'));
      caja.append(el('button', { 'class': 'btn btn-borde', type: 'button', onclick: cerrarSesion }, 'Salir'));
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
    quitarProgreso();
    var r = rutaActual();
    if (r.vista === 'inicio') return vistaInicio();
    if (r.vista === 'revista') return vistaRevista(r.slug);
    if (r.vista === 'articulo') return vistaArticulo(r.slug, r.id);
    return vistaNoEncontrada('La dirección que buscas no existe.');
  }

  function vistaNoEncontrada(mensaje) {
    document.title = 'Página no encontrada | SanColFr';
    app.replaceChildren(
      el('section', { 'class': 'portada' }, el('div', { 'class': 'contenedor' },
        el('h1', {}, 'No encontrado'),
        el('p', {}, mensaje))),
      el('main', { 'class': 'contenedor' },
        el('a', { 'class': 'btn', href: '/', style: 'margin:28px 0 40px', }, 'Ver todas las revistas'))
    );
  }

  // ---------- Buscador de la portada ----------
  function buscadorPortada() {
    return el('form', {
      'class': 'buscador-portada', role: 'search',
      onsubmit: function (e) { e.preventDefault(); buscarEnPortada($('texto-portada').value.trim()); }
    },
      el('input', { id: 'texto-portada', type: 'search', placeholder: 'Busca un título o un autor', 'aria-label': 'Buscar artículos', maxlength: '120' }),
      el('button', { 'class': 'btn btn-acento', type: 'submit' }, 'Buscar'));
  }
  async function buscarEnPortada(texto) {
    var caja = $('dashboard');
    if (!caja) return;
    if (!texto) { cargarDashboard(caja); return; }
    var lista = el('ul', { 'class': 'dash-lista' });
    caja.replaceChildren(el('h3', { 'class': 'dash-titulo' }, 'Resultados para "' + texto + '"'), lista);
    try {
      var r = await api('/articles?search=' + encodeURIComponent(texto));
      if (!r.data.length) lista.append(el('li', {}, 'No encontramos artículos con esa búsqueda.'));
      r.data.forEach(function (a) {
        var detalle = [a.journal_name, a.section && a.section.name].filter(Boolean).join(' · ');
        var item = el('li', {}, el('a', { href: '/revistas/' + a.journal_slug + '/articulos/' + a.id }, a.title));
        if (detalle) item.append(el('span', { 'class': 'meta-revista' }, detalle));
        lista.append(item);
      });
    } catch (e) {
      lista.append(el('li', {}, 'No se pudo completar la búsqueda. Intenta de nuevo.'));
    }
  }

  // ---------- Esqueletos de carga ----------
  function pintarEsqueletos(contenedor, cantidad) {
    if (!contenedor) return;
    contenedor.replaceChildren();
    for (var i = 0; i < cantidad; i++) {
      contenedor.append(el('div', { 'class': 'card esqueleto-tarjeta', 'aria-hidden': 'true' },
        el('div', { 'class': 'esqueleto', style: 'height:22px;width:70%' }),
        el('div', { 'class': 'esqueleto', style: 'height:14px;width:45%' }),
        el('div', { 'class': 'esqueleto', style: 'height:14px;width:90%' })));
    }
  }

  // ---------- Cifras que suben hasta su valor ----------
  function animarContadores(contenedor) {
    if (reducirMovimiento()) return;
    contenedor.querySelectorAll('.dash-n[data-valor]').forEach(function (n) {
      var valorFinal = parseInt(n.getAttribute('data-valor'), 10) || 0;
      if (valorFinal === 0) return;
      var inicio = null;
      n.textContent = '0';
      function paso(t) {
        if (inicio === null) inicio = t;
        var p = Math.min((t - inicio) / 1000, 1);
        var suave = 1 - Math.pow(1 - p, 3);
        n.textContent = String(Math.round(valorFinal * suave));
        if (p < 1) requestAnimationFrame(paso);
      }
      requestAnimationFrame(paso);
    });
  }

  // ---------- Tema claro / oscuro (con el círculo que sale del botón) ----------
  function temaActual() {
    var t = document.documentElement.getAttribute('data-tema');
    if (t) return t;
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oscuro' : 'claro';
  }
  function aplicarTema(t) {
    document.documentElement.setAttribute('data-tema', t);
    try { localStorage.setItem('sc_tema', t); } catch (e) { /* sin almacenamiento: el tema dura solo esta visita */ }
    var b = $('tema');
    if (b) b.textContent = t === 'oscuro' ? 'Modo claro' : 'Modo oscuro';
  }
  function cambiarTema() {
    var nuevo = temaActual() === 'oscuro' ? 'claro' : 'oscuro';
    var boton = $('tema');
    if (!document.startViewTransition || reducirMovimiento() || !boton) return aplicarTema(nuevo);
    var r = boton.getBoundingClientRect();
    var x = r.left + r.width / 2, y = r.top + r.height / 2;
    var radio = Math.hypot(Math.max(x, window.innerWidth - x), Math.max(y, window.innerHeight - y));
    var transicion = document.startViewTransition(function () { aplicarTema(nuevo); });
    transicion.ready.then(function () {
      document.documentElement.animate(
        { clipPath: ['circle(0px at ' + x + 'px ' + y + 'px)', 'circle(' + radio + 'px at ' + x + 'px ' + y + 'px)'] },
        { duration: 650, easing: 'cubic-bezier(0.2, 0.8, 0.2, 1)', pseudoElement: '::view-transition-new(root)' });
    });
  }
  function iniciarTema() {
    var guardado = null;
    try { guardado = localStorage.getItem('sc_tema'); } catch (e) { guardado = null; }
    if (guardado === 'claro' || guardado === 'oscuro') document.documentElement.setAttribute('data-tema', guardado);
    var b = $('tema');
    if (b) {
      b.textContent = temaActual() === 'oscuro' ? 'Modo claro' : 'Modo oscuro';
      b.addEventListener('click', cambiarTema);
    }
  }

  // ---------- Dashboard de inicio (lo ven todos; "Mis favoritos" solo con sesión) ----------
  async function cargarDashboard(contenedor) {
    if (!contenedor) return;
    try {
      var r = await api('/resumen');
      var tarjetas = [
        ['Revistas', r.totales.revistas],
        ['Números', r.totales.numeros],
        ['Artículos publicados', r.totales.articulos_publicados]
      ];
      if (estado.usuario) {
        tarjetas.push(['Mis favoritos', estado.favoritos ? estado.favoritos.size : 0]);
      }
      var lista = el('ul', { 'class': 'dash-lista' });
      if (!r.recientes.length) lista.append(el('li', {}, 'Todavía no hay artículos publicados.'));
      r.recientes.forEach(function (a) {
        var detalle = [a.journal_name, a.section].filter(Boolean).join(' · ');
        var item = el('li', {}, el('a', { href: '/revistas/' + a.journal_slug + '/articulos/' + a.id }, a.title));
        if (detalle) item.append(el('span', { 'class': 'meta-revista' }, detalle));
        lista.append(item);
      });
      var frase = 'Hay ' + plural(tarjetas[0][1], 'revista', 'revistas') + ', ' +
        plural(tarjetas[1][1], 'número', 'números') + ' y ' +
        plural(tarjetas[2][1], 'artículo publicado', 'artículos publicados') + '.';
      if (tarjetas[3]) frase += ' Tienes ' + plural(tarjetas[3][1], 'favorito guardado', 'favoritos guardados') + '.';
      contenedor.replaceChildren(el('p', { 'class': 'dash-resumen' }, frase), el('h3', { 'class': 'dash-titulo' }, 'Lo más reciente'), lista);
    } catch (e) {
      contenedor.replaceChildren();
    }
  }

  // ---------- Vista 1: todas las revistas (cada una es una tapa con su color) ----------
  function tarjetaRevista(j, i) {
    var color = colorValido(j.color, '#1A44D8');
    var numeros = j.issues_count || 0;
    return el('article', { 'class': 'card', style: '--i:' + i + ';--banda:' + color },
      el('h3', {}, el('a', { href: '/revistas/' + j.slug }, j.name)),
      el('p', { 'class': 'meta-revista' },
        j.issn ? el('span', {}, 'ISSN ' + j.issn) : '',
        el('span', {}, numeros + (numeros === 1 ? ' número' : ' números'))),
      el('p', { 'class': 'autores' }, j.description || '')
    );
  }

  async function vistaInicio() {
    document.title = 'Revistas | SanColFr';
    estado.revista = null;
    app.replaceChildren(
      el('section', { 'class': 'portada portada-inicio' }, el('div', { 'class': 'contenedor' },
        titulo('Revistas'),
        el('p', {}, 'Lee, busca y cita artículos de revistas de acceso abierto.'), buscadorPortada())),
      el('main', { 'class': 'contenedor' },
        el('section', { 'class': 'dashboard', id: 'dashboard' }),
        el('h2', { 'class': 'subtitulo' }, 'Revistas publicadas'),
        el('p', { id: 'aviso', role: 'status' }),
        el('div', { 'class': 'rejilla', id: 'lista' }))
    );
    cargarDashboard($('dashboard'));
    pintarEsqueletos($('lista'), 3);
    try {
      var r = await api('/revistas');
      var caja = $('lista');
      caja.replaceChildren();
      if (!r.data.length) caja.append(el('p', { 'class': 'vacio' }, 'Todavía no hay revistas publicadas.'));
      r.data.forEach(function (j, i) { caja.append(tarjetaRevista(j, i)); });
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
      var inicioLote = lista.children.length;
      articulos.forEach(function (a, i) { lista.append(tarjeta(a, inicioLote + i)); });
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

  function tarjeta(a, i) {
    var corazon = botonFavorito(a.id, estado.favoritos.has(a.id), 'fav');
    var revista = a.journal_slug || estado.revista.slug;
    var color = colorValido(estado.revista && estado.revista.color, '#1A44D8');
    return el('article', { 'class': 'card', style: '--i:' + (i || 0) + ';--banda:' + color },
      a.portada_url ? el('img', { 'class': 'portada-tarjeta', src: a.portada_url, alt: 'Primera página de ' + a.title, loading: 'lazy' }) : '',
      a.section ? el('span', { 'class': 'chip' }, a.section.name) : '',
      el('h3', {}, el('a', { href: '/revistas/' + revista + '/articulos/' + a.id }, a.title)),
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

    var pedidosRevista;
    try {
      pedidosRevista = await Promise.all([
        api('/revistas/' + slug),
        api('/revistas/' + slug + '/numeros').catch(function () { return { data: [] }; })
      ]);
    } catch (e) {
      return vistaNoEncontrada('No encontramos esa revista. Revisa la dirección o vuelve a la lista.');
    }
    estado.revista = pedidosRevista[0].data;
    estado.numeros = pedidosRevista[1].data || [];

    var j = estado.revista;
    var ultimo = estado.numeros[0];
    estado.numero = ultimo ? String(ultimo.id) : '';
    estado.soloFavoritos = !!estado.usuario && new URLSearchParams(location.search).get('favoritos') === '1';
    document.title = j.name + ' | SanColFr';

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

    var datosPortada = [j.issn ? 'ISSN ' + j.issn : '', j.publisher || ''].filter(Boolean);
    var portada = el('section', { 'class': 'portada' }, el('div', { 'class': 'contenedor' },
      titulo(j.name),
      el('p', {}, j.description || ''),
      el('div', { 'class': 'meta-portada' }, datosPortada.map(function (d) { return el('span', {}, d); })),
      el('span', { 'class': 'insignia' }, ultimo ? 'Último número: ' + etiquetaNumero(ultimo) : 'Próximamente')
    ));

    var principal = el('main', { 'class': 'contenedor' },
      el('nav', { 'class': 'migas', 'aria-label': 'Ruta' },
        el('a', { href: '/' }, 'Revistas'), ' / ', j.name),
      el('div', { 'class': 'controles' },
        el('div', { 'class': 'fila' },
          selector,
          el('input', { id: 'buscar', type: 'search', placeholder: 'Buscar por título o autor...', 'aria-label': 'Buscar artículos' }),
          btnFav),
        el('div', { 'class': 'chips', id: 'chips', 'aria-label': 'Filtrar por sección' }),
        el('p', { id: 'aviso', role: 'status' })),
      el('div', { 'class': 'rejilla', id: 'lista', 'aria-live': 'polite' }),
      el('button', { id: 'mas', 'class': 'btn btn-borde mas', type: 'button', onclick: function () { estado.pagina += 1; cargarArticulos(false); } }, 'Ver más artículos')
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

    var a, datosRevista = null;
    try {
      var pedidosArticulo = await Promise.all([
        api('/articles/' + id),
        api('/revistas/' + slug).catch(function () { return null; })
      ]);
      a = pedidosArticulo[0].data;
      datosRevista = pedidosArticulo[1] ? pedidosArticulo[1].data : null;
    }
    catch (e) { return vistaNoEncontrada('No encontramos ese artículo. Puede que haya sido retirado.'); }

    var revista = a.journal_slug || slug;
    var nombre = a.journal_name || 'Revista';
    estado.revista = null;
    document.title = a.title + ' | ' + nombre;
    activarProgreso();

    var numero = a.issue ? etiquetaNumero(a.issue) : '';
    var autores = (a.authors || []).join(', ');
    var parrafos = (a.body || '').split(/\n\n+/).filter(Boolean);
    var color = colorValido(datosRevista && datosRevista.color, '#1A44D8');

    var corazon = botonFavorito(a.id, estado.favoritos.has(a.id), 'fav fav-grande');

    var copiar = el('button', {
      'class': 'btn btn-borde', type: 'button',
      onclick: function () {
        var original = copiar.textContent;
        navigator.clipboard.writeText(location.href).then(function () {
          copiar.textContent = 'Enlace copiado';
          setTimeout(function () { copiar.textContent = original; }, 2000);
        }).catch(function () { aviso('No se pudo copiar el enlace.'); });
      }
    }, 'Copiar enlace');

    var citar = el('button', {
      'class': 'btn btn-borde', type: 'button',
      onclick: function () {
        var anio = a.issue && a.issue.year ? a.issue.year : 's. f.';
        var vol = a.issue && a.issue.volume ? ', vol. ' + a.issue.volume : '';
        var num = a.issue && a.issue.number ? ', núm. ' + a.issue.number : '';
        var cita = (autores || 'Autor no indicado') + ' (' + anio + '). ' + a.title + '. ' + nombre + vol + num + '. ' + location.href;
        var original = citar.textContent;
        navigator.clipboard.writeText(cita).then(function () {
          citar.textContent = 'Cita copiada';
          setTimeout(function () { citar.textContent = original; }, 2000);
        }).catch(function () { aviso('No se pudo copiar la cita.'); });
      }
    }, 'Copiar cita');

    var imprimir = el('button', { 'class': 'btn btn-borde', type: 'button', onclick: function () { window.print(); } }, 'Imprimir texto');

    var datos = [nombre, numero, a.start_page ? 'Pág. ' + a.start_page : ''].filter(Boolean);

    var cuerpo = el('main', { 'class': 'articulo contenedor', style: '--banda:' + color },
      el('nav', { 'class': 'migas', 'aria-label': 'Ruta' },
        el('a', { href: '/revistas/' + revista }, 'Números'), ' / ', numero),
      a.section ? el('p', { 'class': 'seccion-articulo' }, a.section.name) : '',
      el('h1', { 'class': 'titulo-articulo' }, a.title),
      autores ? el('p', { 'class': 'autores-articulo' }, autores) : '',
      el('p', { 'class': 'datos-articulo' }, datos.map(function (d) { return el('span', {}, d); })),
      el('div', { 'class': 'acciones-articulo' },
        el('a', { 'class': 'btn', href: '#texto' }, 'Ir al texto'),
        a.pdf_url ? el('a', { 'class': 'btn btn-borde', href: a.pdf_url, download: '' }, 'Descargar PDF') : '',
        copiar,
        citar,
        imprimir,
        corazon),
      el('p', { id: 'aviso', role: 'status' }),
      a.abstract ? el('section', { 'class': 'bloque-resumen' }, el('h2', {}, 'Resumen'), el('p', {}, a.abstract)) : '',
      parrafos.length
        ? el('section', { 'class': 'texto-articulo', id: 'texto' }, el('h2', {}, 'Texto completo'),
            parrafos.map(function (p) { return el('p', {}, p); }))
        : el('p', { id: 'texto' }, 'Este artículo aún no tiene texto disponible.'),
      a.pdf_url ? el('section', { 'class': 'pdf-articulo' },
        el('h2', {}, 'Páginas originales'),
        el('p', { 'class': 'meta-revista' }, 'Así se publicó en la revista.'),
        el('iframe', { 'class': 'visor-pdf', src: a.pdf_url + '#view=FitH', title: 'PDF de ' + a.title })) : '',
      el('a', { 'class': 'btn btn-borde volver', href: '/revistas/' + revista }, 'Volver a la revista')
    );

    app.replaceChildren(cuerpo);
  }

  // ---------- Inicio ----------
  (async function iniciar() {
    iniciarTema();
    if (window.iniciarParticulas) window.iniciarParticulas();
    document.addEventListener('pointerdown', ondaAlPresionar);
    leerSesion();
    pintarSesion();
    await cargarFavoritosIds();
    pintarSesion();
    try { await renderizar(); }
    catch (e) { vistaNoEncontrada('Ocurrió un error al cargar la página. Intenta recargarla.'); }
  })();

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
