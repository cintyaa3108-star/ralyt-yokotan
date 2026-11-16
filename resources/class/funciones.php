<?php
/** Funciones de apoyo usadas por controladores y vistas. */

date_default_timezone_set('America/Mexico_City');
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

// Puntos que da cada nivel al completarse por primera vez
const PUNTOS = [1 => 20, 2 => 30, 3 => 30, 4 => 20];

function h($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

/** URL de una ruta del index: url('lecciones', ['nivel' => 2]) → index.php?ruta=lecciones&nivel=2 */
function url(string $ruta = '', array $params = []): string {
    $q = $ruta !== '' ? ['ruta' => $ruta] + $params : $params;
    return 'index.php' . ($q ? '?' . http_build_query($q) : '');
}
/** Igual que url(), pero lista para imprimir dentro de HTML. */
function u(string $ruta = '', array $params = []): string { return h(url($ruta, $params)); }
function ir(string $ruta, array $params = []) { header('Location: ' . url($ruta, $params)); exit; }

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_campo(): string { return '<input type="hidden" name="csrf" value="' . csrf_token() . '">'; }
function csrf_valido(): bool {
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], (string)$_POST['csrf']);
}

/** Audios en resources/audios/ (en la BD puede venir "saludos/x.mp3" o "audio/saludos/x.mp3"). */
function ruta_audio(?string $a): ?string {
    return $a ? 'resources/audios/' . ltrim(preg_replace('#^audios?/#', '', $a), '/') : null;
}
/** Imágenes de palabras en resources/imagenes/ */
function ruta_imagen(?string $i): ?string { return $i ? 'resources/imagenes/' . ltrim($i, '/') : null; }
