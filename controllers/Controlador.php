<?php
/** Base de todos los controladores: sesión y armado de la página con sus plantillas. */
abstract class Controlador
{
    /** Usuario con sesión iniciada; si no hay, manda al login. */
    protected function usuario(): array {
        if (!empty($_SESSION['uid']) && ($u = Usuario::porId((int)$_SESSION['uid']))) return $u;
        ir('login');
    }

    /**
     * Arma head + navegación + vistas/paginas/$pagina.php + footer.
     * $publico = true usa la barra simple (portada, login, registro); false usa el menú lateral.
     */
    protected function vista(string $pagina, array $datos = [], bool $publico = false): void {
        if (!$publico) $datos['usuario'] ??= $this->usuario();
        extract($datos);
        $base = __DIR__ . '/../vistas/';
        require $base . 'templates/head.php';
        if ($publico) {
            require $base . 'templates/publico_nav.php';
        } else {
            require $base . 'templates/sidebar.php';
            require $base . 'templates/topbar.php';
        }
        require $base . 'paginas/' . $pagina . '.php';
        require $base . 'templates/' . ($publico ? 'footer_publico.php' : 'footer.php');
    }
}
