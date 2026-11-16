// ---------- Menú lateral ocultable ----------
(() => {
  const btn = document.getElementById('btnMenu');
  if (!btn) return;
  const raiz = document.documentElement;
  const pintar = () => {
    const oculto = raiz.classList.contains('side-oculta');
    btn.setAttribute('aria-expanded', String(!oculto));
    btn.setAttribute('aria-label', oculto ? 'Mostrar menú' : 'Ocultar menú');
  };
  btn.addEventListener('click', () => {
    raiz.classList.toggle('side-oculta');
    try { localStorage.setItem('ralyt_menu', raiz.classList.contains('side-oculta') ? 'oculto' : 'visible'); } catch (e) {}
    pintar();
  });
  pintar();
})();

// ---------- Solo suena un audio a la vez ----------
(() => {
  const audios = document.querySelectorAll('audio');
  audios.forEach(a => a.addEventListener('play', () => audios.forEach(o => { if (o !== a) o.pause(); })));
})();

// ---------- Palabra del día (inicio) ----------
(() => {
  const b = document.getElementById('btnPalabra'), a = document.getElementById('audioPalabra');
  if (b && a) b.addEventListener('click', () => a.play().catch(() => {}));
})();

// ---------- Nivel 1: contador de palabras repetidas ----------
(() => {
  const checks = [...document.querySelectorAll('.repetido')];
  if (!checks.length) return;
  const bar = document.getElementById('barN1'), cuenta = document.getElementById('cuentaN1'), btn = document.getElementById('btnN1');
  const act = () => {
    const n = checks.filter(c => c.checked).length;
    bar.style.width = (n / checks.length * 100) + '%';
    cuenta.textContent = n + ' / ' + checks.length;
    btn.disabled = n !== checks.length;
  };
  checks.forEach(c => c.addEventListener('change', act));
  act();
})();

// ---------- Nivel 4: significado al tocar cada palabra ----------
document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el));
