<?php /* Datos del controlador: $usuario, $errores, $aviso, $nivelActual, $hechas, $racha, $posicion, $actividad, $logros */
$abrir = ($errores && in_array($_POST['accion'] ?? '', ['datos', 'password'], true)) ? $_POST['accion'] : '';   // reabre la ventana de edición si hubo errores
?>
<?php if ($aviso): ?><div class="alert alert-success" role="status"><?= h($aviso) ?></div><?php endif; ?>
<?php if ($errores && !$abrir): ?><div class="alert alert-danger" role="alert"><?php foreach ($errores as $e): ?><div><?= h($e) ?></div><?php endforeach; ?></div><?php endif; ?>

<div class="row g-4">
  <div class="col-md-4">
    <div class="card text-center mb-4">
      <div class="card-body">
        <img src="<?= $usuario['avatar'] ? h($usuario['avatar']) : 'resources/imagenes/ajolote.png' ?>" width="120" height="120" class="rounded-circle mb-3" alt="Avatar">
        <h1 class="h5 mb-0"><?= h($usuario['nombre']) ?></h1>
        <p class="text-muted small mb-2">@<?= h($usuario['usuario']) ?> · <?= h($usuario['correo']) ?></p>
        <span class="badge text-bg-primary"><?= h($nivelActual) ?></span>
        <p class="text-muted small mt-3 mb-0">Miembro desde <?= h(date('d/m/Y', strtotime($usuario['creado_en']))) ?></p>
        <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#modalEditar">✏️ Editar información</button>
      </div>
    </div>

    <div class="card border-danger">
      <div class="card-header text-danger">Eliminar cuenta</div>
      <div class="card-body">
        <p class="small text-muted">Se borrarán tu perfil, tus puntos, tu progreso y tu historial. Esta acción no se puede deshacer.</p>
        <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar mi cuenta</button>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="row g-3 mb-4">
      <div class="col-6 col-lg-3"><div class="card text-center"><div class="card-body"><div class="h3 mb-0">⭐ <?= number_format((int)$usuario['puntos']) ?></div><small class="text-muted">Puntos</small></div></div></div>
      <div class="col-6 col-lg-3"><div class="card text-center"><div class="card-body"><div class="h3 mb-0">✅ <?= (int)$hechas ?></div><small class="text-muted">Lecciones finalizadas</small></div></div></div>
      <div class="col-6 col-lg-3"><div class="card text-center"><div class="card-body"><div class="h3 mb-0">🔥 <?= (int)$racha ?></div><small class="text-muted">Días de racha</small></div></div></div>
      <div class="col-6 col-lg-3"><div class="card text-center"><div class="card-body"><div class="h3 mb-0">🏆 #<?= (int)$posicion ?></div><small class="text-muted">En el ranking</small></div></div></div>
    </div>

    <div class="card mb-4" id="logros">
      <div class="card-header d-flex justify-content-between">
        <span>🏅 Logros</span>
        <span class="text-muted"><?= count(array_filter($logros, fn($l) => $l[2])) ?> / <?= count($logros) ?></span>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <?php foreach ($logros as [$ico, $nom, $ok, $desc]): ?>
            <div class="col-6 col-md-3 rl-logro<?= $ok ? '' : ' lock' ?>">
              <div class="medalla"><?= $ok ? $ico : '🔒' ?></div>
              <strong><?= h($nom) ?></strong>
              <div class="small text-muted"><?= h($desc) ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Actividad reciente</div>
      <?php if ($actividad): ?>
      <ul class="list-group list-group-flush">
        <?php foreach ($actividad as $a): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span><?= h($a['descripcion']) ?><br><small class="text-muted"><?= h(date('d/m/Y H:i', strtotime($a['fecha']))) ?></small></span>
            <span class="badge text-bg-success">+<?= (int)$a['puntos'] ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php else: ?>
        <div class="card-body text-muted">Todavía no tienes actividad. ¡Empieza una lección!</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Ventana: editar información -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="tituloEditar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title h5" id="tituloEditar">Editar información</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <?php if ($abrir && $errores): ?><div class="alert alert-danger" role="alert"><?php foreach ($errores as $e): ?><div><?= h($e) ?></div><?php endforeach; ?></div><?php endif; ?>

        <ul class="nav nav-pills nav-fill gap-2 mb-3" role="tablist">
          <li class="nav-item" role="presentation"><button class="nav-link active" id="tabDatos" data-bs-toggle="tab" data-bs-target="#panelDatos" type="button" role="tab" aria-controls="panelDatos" aria-selected="true">Mis datos</button></li>
          <li class="nav-item" role="presentation"><button class="nav-link" id="tabPass" data-bs-toggle="tab" data-bs-target="#panelPass" type="button" role="tab" aria-controls="panelPass" aria-selected="false">Contraseña</button></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane fade show active" id="panelDatos" role="tabpanel" aria-labelledby="tabDatos">
            <form method="post" action="<?= u('perfil') ?>">
              <?= csrf_campo() ?><input type="hidden" name="accion" value="datos">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" class="form-control mb-3" id="nombre" name="nombre" value="<?= h($abrir === 'datos' ? ($_POST['nombre'] ?? '') : $usuario['nombre']) ?>" required>
              <button type="submit" class="btn btn-primary w-100">Guardar cambios</button>
            </form>
          </div>

          <div class="tab-pane fade" id="panelPass" role="tabpanel" aria-labelledby="tabPass">
            <form method="post" action="<?= u('perfil') ?>">
              <?= csrf_campo() ?><input type="hidden" name="accion" value="password">
              <label for="actual" class="form-label">Contraseña actual</label>
              <input type="password" class="form-control mb-3" id="actual" name="actual" autocomplete="current-password" required>
              <label for="nueva" class="form-label">Contraseña nueva</label>
              <input type="password" class="form-control mb-3" id="nueva" name="nueva" autocomplete="new-password" minlength="8" required>
              <label for="confirmar" class="form-label">Confirmar contraseña nueva</label>
              <input type="password" class="form-control mb-3" id="confirmar" name="confirmar" autocomplete="new-password" minlength="8" required>
              <button type="submit" class="btn btn-primary w-100">Cambiar contraseña</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php if ($abrir): ?>
<script>
  // Hubo errores al guardar: se vuelve a abrir la ventana en la pestaña correcta
  document.addEventListener('DOMContentLoaded', () => {
    <?php if ($abrir === 'password'): ?>bootstrap.Tab.getOrCreateInstance(document.getElementById('tabPass')).show();<?php endif; ?>
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditar')).show();
  });
</script>
<?php endif; ?>

<!-- Confirmación para eliminar la cuenta -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="tituloEliminar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="post" action="<?= u('perfil') ?>" class="modal-content">
      <?= csrf_campo() ?><input type="hidden" name="accion" value="eliminar">
      <div class="modal-header">
        <h2 class="modal-title h5" id="tituloEliminar">¿Eliminar tu cuenta?</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p>Perderás tus <strong><?= (int)$usuario['puntos'] ?> puntos</strong>, tu progreso y tu historial. No se puede deshacer.</p>
        <label for="passEliminar" class="form-label">Escribe tu contraseña para confirmar</label>
        <input type="password" class="form-control" id="passEliminar" name="password_eliminar" autocomplete="current-password" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Sí, eliminar mi cuenta</button>
      </div>
    </form>
  </div>
</div>