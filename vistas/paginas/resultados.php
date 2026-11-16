    <div class="py-5 text-center mx-auto" style="max-width: 520px;">
      <div class="display-1">🎉</div>
      <h1 class="h3 mb-1">¡Lección completada!</h1>
      <p class="text-muted mb-3"><?= h($r['nombre']) ?></p>
      <div class="row g-3 mb-4">
        <div class="col-6"><div class="card"><div class="card-body"><div class="h4 mb-0"><?= $r['puntos'] ? '+' . (int)$r['puntos'] : '0' ?></div><small class="text-muted">Puntos<?= $r['puntos'] ? '' : ' (ya la habías completado)' ?></small></div></div></div>
        <div class="col-6"><div class="card"><div class="card-body"><div class="h4 mb-0">💎 <?= (int)$usuario['puntos'] ?></div><small class="text-muted">Total</small></div></div></div>
      </div>
      <?php if ($desbloqueo): ?><div class="alert alert-success">🔓 ¡Desbloqueaste el nivel <?= $desbloqueo ?>!</div><?php endif; ?>
      <a href="<?= u('lecciones',['nivel'=>$desbloqueo ?: (int)$r['nivel']]) ?>" class="btn btn-primary btn-lg w-100">Volver al mapa</a>
    </div>
