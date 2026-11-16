<?php /* Variables: $activa ('inicio','lecciones','abecedario','ranking','perfil'). Abre .rl-layout y <main>; lo cierra footer.php. Los enlaces son rutas del index */
$items = [
    'inicio'     => ['inicio',     '🏠', 'Inicio'],
    'lecciones'  => ['lecciones',  '📖', 'Lecciones'],
    'abecedario' => ['abecedario', 'Aa', 'Abecedario y<br>Vocales'],
    'ranking'    => ['ranking',    '🏆', 'Ranking'],
    'perfil'     => ['perfil',     '👤', 'Perfil'],
];
?>
<div class="rl-layout">
  <aside class="rl-side" id="menuLateral">
    <div class="rl-logo">
      <a href="<?= u('inicio') ?>">
        <div class="flor" aria-hidden="true"><img src="resources/imagenes/loto.png" alt=""></div>
        <p class="nombre">RALYT</p>
        <small>Aprende • Practica • Conecta</small>
      </a>
    </div>
    <nav class="rl-nav" aria-label="Menú principal">
      <?php foreach ($items as $clave => [$href, $ico, $texto]): ?>
        <a href="<?= u($href) ?>"<?= ($activa ?? '') === $clave ? ' class="active" aria-current="page"' : '' ?>><span class="ico"><?= $ico ?></span><span><?= $texto ?></span></a>
      <?php endforeach; ?>
    </nav>
    <a href="<?= u('logout') ?>" class="rl-salir">🚪 Salir</a>
    <div class="rl-pattern" aria-hidden="true"></div>
  </aside>

  <main class="rl-main">
