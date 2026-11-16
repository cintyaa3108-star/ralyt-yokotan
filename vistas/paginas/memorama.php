<?php /* Nivel 2 · Memorama. Datos del controlador: $leccion, $pares */
$json = json_encode($pares, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<a href="<?= u('lecciones',['nivel'=>2]) ?>" class="small text-decoration-none">← Volver a lecciones</a>
<h1 class="h3 mt-2 mb-1">Nivel 2 · Memorama · <?= h($leccion['titulo']) ?></h1>
<p class="text-muted">Voltea las cartas y une cada palabra en yokot'an con su significado en español.</p>

<div class="d-flex justify-content-between align-items-center mb-3">
  <span class="badge text-bg-warning fs-6" id="cuentaN2">Parejas: 0 / <?= count($pares) ?></span>
  <button class="btn btn-outline-secondary btn-sm" type="button" id="reiniciarMemo">Reiniciar</button>
</div>

<div class="row g-3" id="memo"></div>

<div class="alert alert-success d-none mt-4 justify-content-between align-items-center" id="finMemo" role="alert">
  <span>✔ ¡Encontraste todas las parejas! +<?= PUNTOS[2] ?> puntos</span>
  <form method="post" action="<?= u('completar') ?>" class="m-0">
    <?= csrf_campo() ?>
    <input type="hidden" name="leccion_id" value="<?= (int)$leccion['id'] ?>">
    <button type="submit" class="btn btn-success btn-sm">Terminar lección</button>
  </form>
</div>
<script>window.MEMO_PARES = <?= $json ?>;</script>
