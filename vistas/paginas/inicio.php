<div class="row g-4 align-items-center mb-4">
      <div class="col-xl-7">
        <div class="d-flex align-items-center gap-4">
          <img src="resources/imagenes/ajolote.png" alt="Ajolote, mascota de RALYT" class="rl-mascota-img">
          <div>
            <h2 class="display-6 fw-bold mb-1">¡Hola, <?= h($nombre) ?>!</h2>
            <p class="fs-5 mb-0">Hoy es un gran día para aprender yokot'an. 🍂</p>
          </div>
        </div>
      </div>
      <div class="col-xl-5">
        <div class="rl-card d-flex align-items-center gap-3">
          <div class="display-4">🔥</div>
          <div class="flex-grow-1">
            <div class="h4 fw-bold mb-0"><?= $racha ?> días</div>
            <div class="mb-2"><?= $racha ? 'Tu racha continúa' : 'Completa una lección hoy para empezar tu racha' ?></div>
            <div class="rl-bar"><span style="width: <?= $pctRacha ?>%"></span></div>
          </div>
          <div class="display-5">🎁</div>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-xl-8">
        <div class="rl-card mt-4 mb-4">
          <span class="rl-tag">Tu curso</span>
          <div class="d-flex flex-wrap align-items-center gap-3">
            <div class="rl-curso-img" aria-hidden="true">🌿</div>
            <div class="flex-grow-1">
              <h3 class="h4 fw-bold mb-0">Yokot'an</h3>
              <p class="text-muted mb-2">Lengua chontal de Tabasco</p>
              <div class="d-flex align-items-center gap-3">
                <div class="rl-bar flex-grow-1"><span style="width: <?= $pct ?>%"></span></div>
                <strong><?= $pct ?>%</strong>
              </div>
            </div>
            <a href="<?= u('lecciones',['nivel'=>$actual]) ?>" class="rl-btn">▶ Continuar</a>
          </div>
        </div>

        <div class="rl-card mb-4">
          <h3 class="rl-title">Tu camino de aprendizaje</h3>
          <div class="rl-camino">
            <?php foreach ($niveles as $id => $nv): ?>
              <?php $tag = $nv['desbloqueado'] ? 'a' : 'div'; ?>
              <<?= $tag ?> class="rl-paso<?= $nv['completo'] ? ' hecho' : '' ?>" <?= $nv['desbloqueado'] ? 'href="' . u('lecciones',['nivel'=>$id]) . '" style="text-decoration:none"' : '' ?>>
                <div class="circ"><?= $nv['desbloqueado'] ? $iconos[$nv['tipo']] : '🔒' ?></div>
                Nivel <?= $id ?><br><?= h($nv['nombre']) ?>
              </<?= $tag ?>>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-6">
            <div class="rl-card h-100">
              <h3 class="rl-title">📊 Tu progreso</h3>
              <div class="row text-center g-2">
                <div class="col-4"><div class="fs-2">⭐</div><strong class="fs-5"><?= (int)$usuario['puntos'] ?></strong><div class="small">Puntos</div></div>
                <div class="col-4"><div class="fs-2">🏆</div><strong class="fs-5"><?= $racha ?> días</strong><div class="small">Racha</div></div>
                <div class="col-4"><div class="fs-2">🛡️</div><strong class="fs-5">Nivel <?= $actual ?></strong><div class="small">Actual</div></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="rl-banner h-100 d-flex flex-column justify-content-center">
              <h3 class="h5 fw-bold">¡Sigue aprendiendo!</h3>
              <p class="small mb-3">Cada letra te acerca a conocer nuestra cultura.</p>
              <div><a href="<?= u('abecedario') ?>" class="rl-btn sm">Ver abecedario →</a></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4">
        <div class="rl-card mt-xl-4 mb-4">
          <div class="d-flex justify-content-between mb-3">
            <h3 class="rl-title mb-0">🏅 Tus logros</h3>
            <a href="<?= u('perfil') ?>#logros" class="small text-decoration-none" style="color: var(--r-brown)">Ver todos →</a>
          </div>
          <div class="row g-3">
            <?php foreach ($logros as [$ico, $nom, $ok]): ?>
              <div class="col-4 rl-logro<?= $ok ? '' : ' lock' ?>"><div class="medalla"><?= $ok ? $ico : '🔒' ?></div><?= $nom ?></div>
            <?php endforeach; ?>
            <div class="col-4 rl-logro lock"><div class="medalla">🔒</div>???</div>
          </div>
        </div>

        <div class="rl-card">
          <h3 class="rl-title">📅 Palabra del día</h3>
          <?php if ($palabra): ?>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="h3 fw-bold mb-0" lang="chf"><?= h($palabra['yokotan']) ?></div>
              <div class="text-muted">"<?= h($palabra['espanol']) ?>"</div>
            </div>
            <?php if ($audioPalabra): ?>
              <button type="button" class="rl-sonido" id="btnPalabra" aria-label="Escuchar la palabra del día">🔊</button>
              <audio id="audioPalabra" preload="none" src="<?= h($audioPalabra) ?>"></audio>
            <?php endif; ?>
          </div>
          <?php else: ?><p class="text-muted mb-0">Aún no hay palabras cargadas.</p><?php endif; ?>
        </div>
      </div>
    </div>