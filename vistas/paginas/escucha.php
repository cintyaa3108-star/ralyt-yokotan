<?php /* Nivel 1 · Escucha y repite. Datos del controlador: $leccion, $palabras */ ?>
<a href="<?= u('lecciones',['nivel'=>1]) ?>" class="small text-decoration-none">← Volver a lecciones</a>
<h1 class="h3 mt-2 mb-1">Nivel 1 · <?= h($leccion['titulo']) ?></h1>
<p class="text-muted">Escucha cada palabra, repítela en voz alta y márcala cuando la hayas practicado.</p>

<div class="d-flex align-items-center gap-3 mb-4">
  <div class="progress flex-grow-1" role="progressbar" aria-label="Palabras repetidas"><div class="progress-bar" id="barN1" style="width: 0%"></div></div>
  <span class="badge text-bg-warning" id="cuentaN1">0 / <?= count($palabras) ?></span>
</div>

<div class="row g-4">
<?php foreach ($palabras as $p): $audio = ruta_audio($p['audio']); $img = ruta_imagen($p['imagen']); ?>
  <div class="col-md-6 col-lg-4">
    <div class="card h-100 text-center">
      <?php if ($img): ?><img src="<?= h($img) ?>" class="card-img-top frase-img" alt="Ilustración de <?= h($p['espanol']) ?>"><?php endif; ?>
      <div class="card-body">
        <h3 class="frase-yokotan" lang="chf"><?= h($p['yokotan']) ?></h3>
        <div class="divisor my-3"><span>🌸</span></div>
        <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#t<?= $p['id'] ?>">Ver traducción</button>
        <div class="collapse mt-3" id="t<?= $p['id'] ?>"><p class="mb-0 fs-5 text-muted"><?= h($p['espanol']) ?></p></div>
      </div>
      <div class="card-footer bg-transparent border-0 pb-3">
        <?php if ($audio): ?>
          <audio controls preload="none" src="<?= h($audio) ?>">Tu navegador no soporta el elemento de audio.</audio>
        <?php else: ?>
          <p class="small text-muted mb-0">🔇 Audio próximamente</p>
        <?php endif; ?>
        <div class="form-check d-inline-block mt-3">
          <input class="form-check-input repetido" type="checkbox" id="r<?= $p['id'] ?>">
          <label class="form-check-label" for="r<?= $p['id'] ?>">Ya la repetí</label>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<form method="post" action="<?= u('completar') ?>" class="text-end mt-4">
  <?= csrf_campo() ?>
  <input type="hidden" name="leccion_id" value="<?= (int)$leccion['id'] ?>">
  <button type="submit" class="btn btn-primary" id="btnN1" disabled>Terminar lección</button>
</form>
