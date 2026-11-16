    <h1 class="h3 mb-3">Lecciones</h1>
    <?php if ($aviso): ?><div class="alert alert-warning" role="alert"><?= h($aviso) ?></div><?php endif; ?>

    <div class="nav nav-pills nav-fill flex-column flex-md-row gap-2 mb-4">
      <?php foreach ($niveles as $id => $n): ?>
        <?php if ($n['desbloqueado']): ?>
          <a class="nav-link<?= $id === $nivel ? ' active' : '' ?>" href="<?= u('lecciones',['nivel'=>$id]) ?>"><?= $n['completo'] ? '✅' : '▶️' ?> Nivel <?= $id ?> · <?= h($n['nombre']) ?></a>
        <?php else: ?>
          <span class="nav-link disabled"><img src="resources/imagenes/candado_cerrado.svg" alt="" width="16" class="me-1"> Nivel <?= $id ?> · <?= h($n['nombre']) ?></span>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <h2 class="h5">Nivel <?= $nivel ?> · <?= h($nv['nombre']) ?></h2>
    <div class="d-flex align-items-center gap-3 mb-4">
      <div class="progress flex-grow-1" role="progressbar" aria-label="Avance del nivel"><div class="progress-bar" style="width: <?= $pct ?>%"></div></div>
      <span class="badge text-bg-warning"><?= $nv['hechas'] ?> / <?= $nv['total'] ?></span>
    </div>

    <?php if (!$nodos): ?>
      <div class="rl-card text-center py-5"><p class="mb-0 text-muted">Todavía no hay <?= $nivel === 4 ? 'cuentos' : 'lecciones' ?> en este nivel.</p></div>
    <?php else: ?>
      <div class="rl-ruta">
        <?php foreach ($nodos as $i => $nodo): ?>
          <a class="rl-nodo<?= $nodo['hecha'] ? ' hecho' : '' ?>" href="<?= h($nodo['href']) ?>">
            <span class="circ"><?= $nodo['hecha'] ? '✓' : $iconos[$nv['tipo']] ?></span>
            <span class="tit"><?= h($nodo['titulo']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
