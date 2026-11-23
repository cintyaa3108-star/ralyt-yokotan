<?php /* Variables: $usuario */ ?>
    <div class="rl-top mb-3">
      <button type="button" class="rl-toggle" id="btnMenu" aria-controls="menuLateral" aria-expanded="true" aria-label="Ocultar menú">☰</button>
      <span>🔥 <?= Usuario::rachaEfectiva($usuario) ?> días</span>
      <span>💎 <?= (int)$usuario['puntos'] ?></span>
      <a href="<?= u('perfil') ?>" class="rl-avatar" aria-label="Mi perfil"><img src="<?= $usuario['avatar'] ? h($usuario['avatar']) : 'resources/imagenes/ajolote.png' ?>"<?= $usuario['avatar'] ? ' class="avatar-foto"' : '' ?> alt=""></a>
    </div>