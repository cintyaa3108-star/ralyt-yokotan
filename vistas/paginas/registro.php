<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-5">
      <div class="card">
        <div class="card-body p-4">
          <img src="resources/imagenes/ajolote.png" alt="Ajolote, mascota de RALYT" width="110" class="d-block mx-auto mb-2">
          <h1 class="h3 text-center mb-4">Crear cuenta</h1>

          <?php if ($errores): ?>
            <div class="alert alert-danger" role="alert"><?php foreach ($errores as $e): ?><div><?= h($e) ?></div><?php endforeach; ?></div>
          <?php endif; ?>

          <form method="post" action="<?= u('registro') ?>">
            <?= csrf_campo() ?>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="nombre" name="nombre" value="<?= h($v['nombre']) ?>" autocomplete="name" required>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="usuario" value="<?= h($v['usuario']) ?>" autocomplete="username" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="correo" value="<?= h($v['correo']) ?>" autocomplete="email" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" minlength="8" required>
              </div>
              <div class="col-md-6 mb-4">
                <label for="password2" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="password2" name="password2" autocomplete="new-password" minlength="8" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Registrarme</button>
          </form>

          <p class="text-center small text-muted mt-3 mb-0">¿Ya tienes cuenta? <a href="<?= u('login') ?>" class="link-dark">Inicia sesión</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
