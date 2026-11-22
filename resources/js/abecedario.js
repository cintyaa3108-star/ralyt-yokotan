(() => {
  const tiles = [...document.querySelectorAll('.letra-tile')];
  if (!tiles.length) return;
  const $ = (id) => document.getElementById(id);
  const btn = $('dSonido'), sinAudio = $('dSinAudio');
  let audio = null;

  function elegir(t, reproducir) {
    tiles.forEach(x => x.classList.toggle('active', x === t));
    $('dLetra').textContent = t.dataset.letra;
    $('dEjemplo').textContent = t.dataset.ejemplo || 'Aún sin ejemplo';
    $('dSig').textContent = t.dataset.sig || '';
    if (audio) audio.pause();
    audio = t.dataset.audio ? new Audio(t.dataset.audio) : null;
    btn.disabled = !audio;
    sinAudio.classList.toggle('d-none', !!audio);
    if (audio && reproducir) audio.play().catch(() => {});
  }

  tiles.forEach(t => t.addEventListener('click', () => elegir(t, true)));
  btn.addEventListener('click', () => { if (audio) { audio.currentTime = 0; audio.play().catch(() => {}); } });
  elegir(tiles[0], false);
})();