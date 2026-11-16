<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
      <div class="card">
        <div class="card-body p-4">
          <img src="resources/imagenes/ajolote.png" alt="Ajolote, mascota de RALYT" width="110" class="d-block mx-auto mb-2">
          <h1 class="h3 text-center mb-4">Iniciar sesión</h1>

          <?php if ($aviso): ?><div class="alert alert-success" role="status"><?= h($aviso) ?></div><?php endif; ?>
          <?php if ($error): ?><div class="alert alert-danger" role="alert"><?= h($error) ?></div><?php endif; ?>

          <form method="post" action="<?= u('login') ?>">
            <?= csrf_campo() ?>
            <div class="mb-3">
              <label for="username" class="form-label">Usuario o correo</label>
              <input type="text" class="form-control" id="username" name="usuario" value="<?= h($_POST['usuario'] ?? '') ?>" autocomplete="username" required autofocus>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
          </form>

          <p class="text-center small text-muted mt-3 mb-0">¿No tienes cuenta? <a href="<?= u('registro') ?>" class="link-dark">Regístrate</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
