<?php /* Nivel 4 · Lectura. Datos del controlador: $cuento, $dic, $yaLeido */
$partes = preg_split('/(\s+)/u', $cuento['texto_yokotan'], -1, PREG_SPLIT_DELIM_CAPTURE);
?>
<a href="<?= u('lecciones',['nivel'=>4]) ?>" class="small text-decoration-none">← Volver a lecciones</a>
<h1 class="h3 mt-2 mb-1">Nivel 4 · Lectura</h1>
<p class="text-muted">Lee la leyenda en yokot'an. Toca cualquier palabra subrayada para ver su significado.</p>

<div class="card">
  <div class="card-body p-4">
    <h2 class="h4 mb-3"><?= h($cuento['titulo']) ?></h2>

    <p class="texto-cuento" lang="chf"><?php
      foreach ($partes as $p) {
          if ($p === '' || preg_match('/^\s+$/u', $p)) { echo nl2br(h($p)); continue; }
          $limpia = trim($p, ".,;:!?¿¡\"“”()«»—–-");
          $norm   = str_replace(['’', '‘'], "'", mb_strtolower($limpia));
          $sig    = $dic[$limpia] ?? $dic[mb_strtolower($limpia)] ?? $dic[$norm] ?? null;

          if ($sig !== null && $limpia !== '') {
              $ini = mb_strpos($p, $limpia); 
              $pre = mb_substr($p, 0, $ini); 
              $post = mb_substr($p, $ini + mb_strlen($limpia));
              echo h($pre) . '<span class="palabra" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="right" data-bs-title="' . h($limpia) . '" data-bs-content="' . h($sig) . '">' . h($limpia) . '</span>' . h($post);
          } else {
              echo h($p);
          }
      }
    ?></p>

    <hr>
    <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#trad4">Ver traducción completa</button>
    <div class="collapse mt-3" id="trad4"><div class="p-3 bg-body-secondary"><?= nl2br(h($cuento['traduccion'])) ?></div></div>
  </div>
  <div class="card-footer bg-transparent text-end">
    <form method="post" action="<?= u('completar') ?>" class="m-0">
      <?= csrf_campo() ?>
      <input type="hidden" name="cuento_id" value="<?= (int)$cuento['id'] ?>">
      <button type="submit" class="btn btn-primary btn-sm"><?= $yaLeido ? 'Leído ✓ (volver a marcar)' : 'Marcar como leído (+' . PUNTOS[4] . ' ⭐)' ?></button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const elementos = document.querySelectorAll('[data-bs-toggle="popover"]');

    elementos.forEach(function (elemento) {
        new bootstrap.Popover(elemento, {
            trigger: 'focus',
            placement: 'right'
        });
    });
});
</script>