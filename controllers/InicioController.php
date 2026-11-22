<?php
class InicioController extends Controlador
{
    /** Portada pública. */
    public function portada(): void {
        if (!empty($_SESSION['uid'])) ir('inicio');
        $esquema = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $enlace  = $esquema . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
        $this->vista('portada', [
            'titulo' => 'Inicio', 'enlace' => $enlace, 'enc' => rawurlencode($enlace), 'texto' => rawurlencode("Aprende yokot'an jugando"),
        ], true);
    }

    /** Panel del usuario. */
    public function index(): void {
        $usuario = $this->usuario();
        $niveles = Nivel::estados((int)$usuario['id']);
        $racha   = Usuario::rachaEfectiva($usuario);
        $hechas  = array_sum(array_column($niveles, 'hechas'));
        $total   = array_sum(array_column($niveles, 'total'));
        $palabra = Palabra::delDia();

        $this->vista('inicio', [
            'titulo' => 'Inicio', 'activa' => 'inicio', 'usuario' => $usuario,
            'niveles' => $niveles, 'racha' => $racha, 'actual' => Nivel::actual($niveles),
            'pct' => $total ? (int)round($hechas * 100 / $total) : 0,
            'pctRacha' => $racha ? (int)round((($racha - 1) % 7 + 1) / 7 * 100) : 0,
            'nombre' => explode(' ', trim($usuario['nombre']))[0],
            'iconos' => ['escucha' => '🎧', 'memorama' => '🃏', 'escritura' => '✍️', 'lectura' => '📖'],
            'palabra' => $palabra, 'audioPalabra' => ruta_audio($palabra['audio'] ?? null),
            'logros' => array_slice(Logro::todos($usuario, $niveles, $racha), 0, 5),
        ]);
    }
}