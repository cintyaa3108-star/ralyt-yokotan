<?php /* Nivel 3 · Escritura. Datos del controlador: $leccion, $frases */
$json = json_encode($frases, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<a href="<?= u('lecciones',['nivel'=>3]) ?>" class="small text-decoration-none">← Volver a lecciones</a>
<h1 class="h3 mt-2 mb-1">Nivel 3 · Escritura · <?= h($leccion['titulo']) ?></h1>
<p class="text-muted">Escucha el audio (o lee la pista) y ordena las palabras para formar la frase.</p>

<?php if (!$frases): ?>
  <div class="alert alert-warning">Esta lección todavía no tiene frases.</div>
<?php else: ?>
<div class="d-flex justify-content-end mb-2"><span class="badge text-bg-warning" id="cuentaN3"></span></div>

<div class="card mb-4"><div class="card-body">
  <div id="audioFrase"></div>
  <button class="btn btn-secondary btn-sm mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#pista3">Ver pista en yokotan</button>
  <div class="collapse mt-2" id="pista3"><span class="text-muted" id="textoPista"></span></div>
</div></div>

<p class="mb-2 fw-semibold">Tu frase:</p>
<div class="zona mb-3" id="respuesta" lang="chf"></div>
<p class="mb-2 fw-semibold">Palabras disponibles:</p>
<div class="zona mb-4" id="banco" lang="chf"></div>

<div class="alert d-none" id="fb3" role="alert"></div>

<div class="d-flex gap-2 flex-wrap">
  <button type="button" class="btn btn-primary" id="comprobar">Comprobar</button>
  <button type="button" class="btn btn-outline-secondary" id="limpiar">Limpiar</button>
  <button type="button" class="btn btn-success d-none" id="siguiente">Siguiente frase →</button>
  <form method="post" action="<?= u('completar') ?>" class="m-0 d-none" id="formFin">
    <?= csrf_campo() ?>
    <input type="hidden" name="leccion_id" value="<?= (int)$leccion['id'] ?>">
    <button type="submit" class="btn btn-success">Terminar lección (+<?= PUNTOS[3] ?>)</button>
  </form>
</div>
<script>window.FRASES = <?= $json ?>;</script>
<?php endif; ?>
