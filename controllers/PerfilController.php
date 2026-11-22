<?php
class PerfilController extends Controlador
{
    public function index(): void {
        $usuario = $this->usuario();
        $uid     = (int)$usuario['id'];
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_valido()) {
                $errores[] = 'La sesión expiró. Intenta de nuevo.';
            } elseif (($_POST['accion'] ?? '') === 'datos') {
                $nombre = trim($_POST['nombre'] ?? '');
                if (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 100) {
                    $errores[] = 'Escribe un nombre válido (entre 2 y 100 caracteres).';
                } else {
                    Usuario::actualizarNombre($uid, $nombre);
                    $_SESSION['aviso'] = 'Tu nombre se actualizó.';
                    ir('perfil');
                }
            } elseif (($_POST['accion'] ?? '') === 'password') {
                $nueva = $_POST['nueva'] ?? '';
                if (!password_verify($_POST['actual'] ?? '', $usuario['password_hash'])) $errores[] = 'La contraseña actual no es correcta.';
                if (strlen($nueva) < 8)                    $errores[] = 'La contraseña nueva debe tener al menos 8 caracteres.';
                if ($nueva !== ($_POST['confirmar'] ?? '')) $errores[] = 'La confirmación no coincide.';
                if (!$errores) {
                    Usuario::cambiarPassword($uid, $nueva);
                    $_SESSION['aviso'] = 'Tu contraseña se cambió.';
                    ir('perfil');
                }
            } elseif (($_POST['accion'] ?? '') === 'eliminar') {
                if (!password_verify($_POST['password_eliminar'] ?? '', $usuario['password_hash'])) {
                    $errores[] = 'La contraseña no es correcta; tu cuenta no se eliminó.';
                } else {
                    Usuario::eliminar($uid);
                    $_SESSION = [];
                    session_regenerate_id(true);
                    $_SESSION['aviso'] = 'Tu cuenta fue eliminada.';
                    ir('login');
                }
            }
        }
        $aviso = $_SESSION['aviso'] ?? '';
        unset($_SESSION['aviso']);

        $niveles = Nivel::estados($uid);
        $nombreNivel = $niveles[Nivel::actual($niveles)];
        $racha = Usuario::rachaEfectiva($usuario);
        $this->vista('perfil', [
            'titulo' => 'Perfil', 'activa' => 'perfil', 'usuario' => $usuario,
            'errores' => $errores, 'aviso' => $aviso,
            'nivelActual' => 'Nivel ' . $nombreNivel['id'] . ': ' . $nombreNivel['nombre'],
            'hechas' => array_sum(array_column($niveles, 'hechas')),
            'racha' => $racha, 'logros' => Logro::todos($usuario, $niveles, $racha),
            'posicion' => Ranking::posicion($uid),
            'actividad' => Usuario::actividad($uid, 8),
        ]);
    }
}