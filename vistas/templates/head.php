<?php /* Variables: $titulo */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($titulo ?? 'RALYT') ?> | RALYT</title>
  <link rel="icon" href="resources/imagenes/ajolote.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="resources/css/style.css" rel="stylesheet">
  <!-- Recuerda si el menú estaba oculto (antes de pintar la página para evitar parpadeos) -->
  <script>try { if (localStorage.getItem('ralyt_menu') === 'oculto') document.documentElement.classList.add('side-oculta'); } catch (e) {}</script>
</head>
<body>
