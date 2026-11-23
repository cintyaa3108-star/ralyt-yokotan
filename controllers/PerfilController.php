<?php
class PerfilController extends Controlador
{
    public function index(): void {
        $usuario = $this->usuario();
        $uid     = (int)$usuario['id'];
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST) && !empty($_SERVER['CONTENT_LENGTH'])) {
                $errores[] = 'La imagen es demasiado grande (máximo 2 MB).';
            } elseif (!csrf_valido()) {
                $errores[] = 'La sesión expiró. Intenta de nuevo.';
            } elseif (($_POST['accion'] ?? '') === 'datos') {
                $nombre = trim($_POST['nombre'] ?? '');
                if (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 100) {
                    $errores[] = 'Escribe un nombre válido (entre 2 y 100 caracteres).';
                } else {
                    Usuario::actualizarNombre($uid, $nombre);
                    $_SESSION['aviso'] = 'Tu información se actualizó.';
                    ir('perfil');
                }
            } elseif (($_POST['accion'] ?? '') === 'avatar') {
                [$nuevaFoto, $errorFoto] = self::guardarFoto($_FILES['avatar'] ?? null, $uid);
                if ($errorFoto) {
                    $errores[] = $errorFoto;
                } else {
                    self::borrarFoto($usuario['avatar']);
                    Usuario::actualizarAvatar($uid, $nuevaFoto);
                    $_SESSION['aviso'] = 'Tu foto de perfil se actualizó.';
                    ir('perfil');
                }
            } elseif (($_POST['accion'] ?? '') === 'avatar_quitar') {
                self::borrarFoto($usuario['avatar']);
                Usuario::actualizarAvatar($uid, null);
                $_SESSION['aviso'] = 'Quitaste tu foto de perfil.';
                ir('perfil');
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
                    self::borrarFoto($usuario['avatar']);
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

    private const DIR_FOTOS = 'resources/imagenes/avatares/';

    /** Valida la foto, la recorta en cuadrado y la guarda a 300x300 en resources/imagenes/avatares/. Devuelve [ruta, error]. */
/** Valida la foto y la guarda en resources/imagenes/avatares/ sin requerir GD. Devuelve [ruta, error]. */
    private static function guardarFoto(?array $f, int $uid): array {
        if (!$f || $f['error'] === UPLOAD_ERR_NO_FILE) return [null, 'Elige una imagen primero.'];
        if ($f['error'] === UPLOAD_ERR_INI_SIZE || $f['error'] === UPLOAD_ERR_FORM_SIZE || $f['size'] > 2 * 1024 * 1024) {
            return [null, 'La imagen es demasiado grande (máximo 2 MB).'];
        }
        if ($f['error'] !== UPLOAD_ERR_OK) return [null, 'No se pudo subir la imagen. Intenta de nuevo.'];

        $info = @getimagesize($f['tmp_name']);
        $permitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        ];
        if (!$info || !isset($permitidos[$info['mime']])) {
            return [null, 'Formato no válido. Usa una imagen JPG, PNG o WebP.'];
        }

        $dir = __DIR__ . '/../' . self::DIR_FOTOS;
        if (!is_dir($dir) && !mkdir($dir, 0775, true)) return [null, 'No se pudo guardar la imagen en el servidor.'];

        $nombreArchivo = 'u' . $uid . '_' . bin2hex(random_bytes(6)) . '.' . $permitidos[$info['mime']];
        $destino = $dir . $nombreArchivo;

        if (!move_uploaded_file($f['tmp_name'], $destino)) {
            return [null, 'No se pudo guardar la imagen en el servidor.'];
        }

        return [self::DIR_FOTOS . $nombreArchivo, null];
    }

    /** Borra la foto anterior (solo si está en la carpeta de avatares). */
    private static function borrarFoto(?string $ruta): void {
        if ($ruta && strpos($ruta, self::DIR_FOTOS) === 0) {
            $archivo = __DIR__ . '/../' . $ruta;
            if (is_file($archivo)) @unlink($archivo);
        }
    }
}