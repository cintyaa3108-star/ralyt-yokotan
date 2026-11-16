<main class="container py-5">
  <div class="row align-items-center g-5">
    <div class="col-lg-6 text-center text-lg-start">
      <h1 class="rl-hero-title mb-2">RALYT</h1>
      <p class="fw-bold text-muted mb-4">Aprende • Practica • Conecta</p>
      <p class="fs-4 mb-4">Aprende yokot'an jugando. Gana puntos, sube de nivel y compite con tus compañeros.</p>
      <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
        <a href="<?= u('registro') ?>" class="btn btn-primary btn-lg px-5 py-3">Crear cuenta</a>
        <a href="<?= u('login') ?>" class="btn btn-outline-primary btn-lg px-5 py-3">Iniciar sesión</a>
      </div>
    </div>
    <div class="col-lg-6 text-center">
      <img src="resources/imagenes/ajolote.png" alt="Ajolote leyendo, mascota de RALYT" class="img-fluid" style="max-width: 440px;">
    </div>
  </div>

  <section class="rl-banner text-center mt-5 py-5">
    <h2 class="h3 fw-bold">¡Corre la voz sobre RALYT!</h2>
    <p class="mb-4">Invita a tus amigos y sube juntos en el ranking.</p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="#compartir" class="btn btn-warning px-4">Compartir</a>
      <a href="<?= u('registro') ?>" class="btn btn-light px-4">Prueba RALYT</a>
    </div>
  </section>
</main>

<!-- Modal compartir (solo HTML/CSS) -->
<div id="compartir" class="modal-css">
  <a href="#" class="modal-fondo" aria-label="Cerrar"></a>
  <div class="card modal-caja">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Compartir RALYT</h2>
        <a href="#" class="btn-close" aria-label="Cerrar"></a>
      </div>
      <label for="enlace" class="form-label">Enlace de la página</label>
      <input type="text" class="form-control mb-4" id="enlace" value="<?= h($enlace) ?>" readonly onfocus="this.select()">
      <p class="mb-2">Compartir en:</p>
      <div class="row g-2">
        <div class="col-6"><a class="btn btn-primary w-100" target="_blank" rel="noopener" href="https://wa.me/?text=<?= $texto ?>%20<?= $enc ?>">WhatsApp</a></div>
        <div class="col-6"><a class="btn btn-info w-100" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?= $enc ?>">Facebook</a></div>
        <div class="col-6"><a class="btn btn-secondary w-100" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?text=<?= $texto ?>&url=<?= $enc ?>">X (Twitter)</a></div>
        <div class="col-6"><a class="btn btn-info w-100" target="_blank" rel="noopener" href="https://t.me/share/url?url=<?= $enc ?>&text=<?= $texto ?>">Telegram</a></div>
        <div class="col-12"><a class="btn btn-warning w-100" href="mailto:?subject=<?= $texto ?>&body=<?= $enc ?>">Correo electrónico</a></div>
      </div>
    </div>
  </div>
</div>
