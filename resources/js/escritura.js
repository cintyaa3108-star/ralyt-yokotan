(() => {
  const frases = window.FRASES;
  if (!frases || !frases.length) return;
  const $ = (id) => document.getElementById(id);
  const resp = $('respuesta'), banco = $('banco'), fb = $('fb3'), btnSig = $('siguiente'), formFin = $('formFin');
  let i = 0, resuelta = false;

  const mezclar = (arr) => { for (let k = arr.length - 1; k > 0; k--) { const j = Math.floor(Math.random() * (k + 1)); [arr[k], arr[j]] = [arr[j], arr[k]]; } return arr; };
  const tokens = (t) => t.trim().split(/\s+/);

  function cargar() {
    const f = frases[i];
    resuelta = false;
    resp.innerHTML = ''; banco.innerHTML = '';
    fb.classList.add('d-none'); btnSig.classList.add('d-none'); formFin.classList.add('d-none');
    $('comprobar').disabled = false;
    $('cuentaN3').textContent = 'Frase ' + (i + 1) + ' / ' + frases.length;
    $('textoPista').textContent = f.espanol;

    const cont = $('audioFrase'); cont.innerHTML = '';
    if (f.audio) {
      const a = document.createElement('audio'); a.controls = true; a.preload = 'none'; a.src = f.audio; cont.appendChild(a);
    } else {
      cont.innerHTML = '<p class="small text-muted mb-0">🔇 Audio próximamente.</p>';
    }

    const original = tokens(f.yokotan);
    let orden = mezclar([...original]);
    if (original.length > 2) { let intentos = 0; while (orden.join(' ') === original.join(' ') && intentos++ < 10) mezclar(orden); }
    orden.forEach(t => {
      const b = document.createElement('button');
      b.type = 'button'; b.className = 'btn btn-secondary chip'; b.textContent = t;
      b.addEventListener('click', () => {
        if (resuelta) return;
        (b.parentElement === banco ? resp : banco).appendChild(b);
        fb.classList.add('d-none');
      });
      banco.appendChild(b);
    });
  }

  $('limpiar').addEventListener('click', () => {
    if (resuelta) return;
    [...resp.children].forEach(c => banco.appendChild(c));
    fb.classList.add('d-none');
  });

  $('comprobar').addEventListener('click', () => {
    if (resuelta) return;
    const intento = [...resp.children].map(c => c.textContent).join(' ');
    const bien = intento === tokens(frases[i].yokotan).join(' ');
    fb.className = 'alert ' + (bien ? 'alert-success' : 'alert-danger');
    fb.textContent = bien ? '✔ ¡Correcto!' : '✖ Todavía no. Revisa el orden e inténtalo de nuevo.';
    if (bien) {
      resuelta = true; $('comprobar').disabled = true;
      (i < frases.length - 1 ? btnSig : formFin).classList.remove('d-none');
    }
  });

  btnSig.addEventListener('click', () => { i++; cargar(); });
  cargar();
})();
