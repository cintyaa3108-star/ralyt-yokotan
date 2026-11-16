<h1 class="h3 mb-3">Ranking</h1>
<div class="rl-card">
  <table class="table align-middle mb-0">
    <thead><tr><th>#</th><th>Usuario</th><th class="text-end">Lecciones</th><th class="text-end">Puntos</th></tr></thead>
    <tbody>
    <?php foreach (array_slice($top, 0, 5) as $f): ?>
      <tr class="<?= (int)$f['id'] === (int)$usuario['id'] ? 'table-primary' : '' ?>">
        <td><?= (int)$f['posicion'] ?></td>
        <td><?= h($f['nombre']) ?> <small class="text-muted">@<?= h($f['usuario']) ?></small></td>
        <td class="text-end"><?= (int)$f['lecciones_completadas'] ?></td>
        <td class="text-end fw-bold"><?= (int)$f['puntos'] ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
  <?php if ($miPos > 5): ?><p class="mt-3 mb-0 text-muted">Tu posición: #<?= (int)$miPos ?></p><?php endif; ?>
</div>