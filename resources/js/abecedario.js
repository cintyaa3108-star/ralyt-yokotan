(() => {
  const tiles = [...document.querySelectorAll('.letra-tile')];
  if (!tiles.length) return;
  const $ = (id) => document.getElementById(id);

  function elegir(t) {
    tiles.forEach(x => x.classList.toggle('active', x === t));
    $('dLetra').textContent = t.dataset.letra;
    $('dEjemplo').textContent = t.dataset.ejemplo || 'Aún sin ejemplo';
    $('dSig').textContent = t.dataset.sig || '';
  }

  tiles.forEach(t => t.addEventListener('click', () => elegir(t)));
  elegir(tiles[0]);
})();