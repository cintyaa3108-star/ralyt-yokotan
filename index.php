<?php
/**
 * index.php — Controlador frontal. Aquí SOLO viven las rutas:
 * cada ruta apunta a un método de un controlador (controllers/).
 * Los enlaces del navbar son rutas, p. ej.:  index.php?ruta=lecciones
 */
require __DIR__ . '/resources/class/funciones.php';

// Carga automática de clases (controladores, modelos y clases de resources/class)
spl_autoload_register(function (string $clase) {
    foreach (['controllers', 'models', 'resources/class'] as $carpeta) {
        $archivo = __DIR__ . "/$carpeta/$clase.php";
        if (is_file($archivo)) { require $archivo; return; }
    }
});

// ruta => [Controlador, método]
$rutas = [
    'portada'    => ['InicioController',   'portada'],
    'login'      => ['AuthController',     'login'],
    'registro'   => ['AuthController',     'registro'],
    'logout'     => ['AuthController',     'logout'],
    'inicio'     => ['InicioController',   'index'],
    'lecciones'  => ['LeccionesController', 'mapa'],
    'actividad'  => ['LeccionesController', 'actividad'],
    'completar'  => ['LeccionesController', 'completar'],
    'resultados' => ['LeccionesController', 'resultados'],
    'ranking'    => ['RankingController',  'index'],
    'abecedario' => ['AbecedarioController', 'index'],
    'perfil'     => ['PerfilController',   'index'],
];

$ruta = $_GET['ruta'] ?? (!empty($_SESSION['uid']) ? 'inicio' : 'portada');
if (!isset($rutas[$ruta])) {
    http_response_code(404);
    exit('Página no encontrada.');
}
[$controlador, $metodo] = $rutas[$ruta];
(new $controlador())->$metodo();