v<?php /* Datos del controlador: $vocales, $quebradas, $consonantes */
$tile = function (array $l, bool $vocal) {
    $audio = ruta_audio($l['audio']);
    echo '<div class="col-3 col-md-2"><button type="button" class="letra-tile' . ($vocal ? ' vocal' : '') . '" lang="chf"'
       . ' data-letra="' . h($l['letra']) . '" data-ejemplo="' . h($l['ejemplo_yokotan']) . '" data-sig="' . h($l['ejemplo_espanol']) . '"'
       . ' data-audio="' . h($audio) . '">' . h($l['letra']) . '</button></div>';
};
?>
<h1 class="h3 fw-bold mb-1">Abecedario y vocales</h1>
<p class="text-muted mb-4">Toca una letra para escuchar cómo suena y ver una palabra de ejemplo.</p>

<div class="row g-4">
  <div class="col-lg-8">
    <?php if ($vocales): ?>
    <div class="rl-card mb-4">
      <h2 class="rl-title">Vocales</h2>
      <div class="row g-3"><?php foreach ($vocales as $l) $tile($l, true); ?></div>
    </div>
    <?php endif; ?>

    <?php if ($quebradas): ?>
    <div class="rl-card mb-4">
      <h2 class="rl-title">Vocales quebradas</h2>
      <div class="row g-3"><?php foreach ($quebradas as $l) $tile($l, true); ?></div>
    </div>
    <?php endif; ?>

    <?php if ($consonantes): ?>
    <div class="rl-card">
      <h2 class="rl-title">Abecedario</h2>
      <div class="row g-3"><?php foreach ($consonantes as $l) $tile($l, false); ?></div>
    </div>
    <?php endif; ?>
  </div>

  <div class="col-lg-4">
    <div class="rl-card rl-detalle">
      <p class="text-muted mb-0">Letra seleccionada</p>
      <div class="grande" id="dLetra" lang="chf">·</div>
      <button type="button" class="rl-sonido mb-1" id="dSonido" aria-label="Escuchar la letra" disabled>🔊</button>
      <p class="small text-muted mb-3" id="dSinAudio">🔇 Audio próximamente</p>
      <hr>
      <p class="mb-1 small text-muted">Ejemplo</p>
      <div class="h4 fw-bold mb-0" id="dEjemplo" lang="chf">—</div>
      <div class="text-muted" id="dSig"></div>
    </div>
  </div>
</div>