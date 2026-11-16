(() => {
  const pares = window.MEMO_PARES;
  if (!pares) return;
  const memo = document.getElementById('memo');
  const cuenta = document.getElementById('cuentaN2');
  const fin = document.getElementById('finMemo');
  let primera = null, bloqueo = false, aciertos = 0;

  const CARPETA_IMG = 'resources/img/';

  const mezclar = (arr) => {
    for (let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
  };

  function crearCarta(par, texto, yokotan, imagen = null) {
    const col = document.createElement('div');
    col.className = 'col-4 col-md-3 col-lg-2';
    const b = document.createElement('button');
    b.type = 'button';
    b.className = 'memo-card w-100';
    b.style.minHeight = '140px';
    b.dataset.par = par;

    const f = document.createElement('span');
    f.className = 'memo-front';
    f.textContent = '?';

    // Sin 'd-flex' para respetar el CSS que la mantiene oculta hasta voltear
    const r = document.createElement('span');
    r.className = 'memo-back';

    if (imagen) {
      const img = document.createElement('img');
      img.src = imagen.includes('/') ? imagen : CARPETA_IMG + imagen;
      img.alt = texto;
      img.style.display = 'block';
      img.style.margin = '0 auto 6px auto';
      img.style.maxHeight = '65px';
      img.style.objectFit = 'contain';
      r.appendChild(img);
    }

    const spanTxt = document.createElement('span');
    spanTxt.textContent = texto;
    if (yokotan) spanTxt.lang = 'chf';
    r.appendChild(spanTxt);

    b.append(f, r);
    col.appendChild(b);
    b.addEventListener('click', () => voltear(b));
    return col;
  }

  function iniciar() {
    memo.innerHTML = '';
    primera = null; bloqueo = false; aciertos = 0;
    cuenta.textContent = 'Parejas: 0 / ' + pares.length;
    fin.classList.add('d-none'); fin.classList.remove('d-flex');
    const cartas = [];
    pares.forEach(p => {
      cartas.push(crearCarta(p.id, p.yokotan, true, null));
      cartas.push(crearCarta(p.id, p.espanol, false, p.imagen));
    });
    mezclar(cartas).forEach(c => memo.appendChild(c));
  }

  function voltear(c) {
    if (bloqueo || c.classList.contains('volteada')) return;
    c.classList.add('volteada');
    if (!primera) { primera = c; return; }
    if (primera.dataset.par === c.dataset.par) {
      primera.classList.add('acertada'); c.classList.add('acertada');
      primera = null; aciertos++;
      cuenta.textContent = 'Parejas: ' + aciertos + ' / ' + pares.length;
      if (aciertos === pares.length) { fin.classList.remove('d-none'); fin.classList.add('d-flex'); }
    } else {
      bloqueo = true;
      const a = primera; primera = null;
      setTimeout(() => { a.classList.remove('volteada'); c.classList.remove('volteada'); bloqueo = false; }, 900);
    }
  }

  document.getElementById('reiniciarMemo').addEventListener('click', iniciar);
  iniciar();
})();