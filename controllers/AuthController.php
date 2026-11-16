<?php
class AuthController extends Controlador
{
    public function login(): void {
        if (!empty($_SESSION['uid'])) ir('inicio');
        $error = '';
        $aviso = $_SESSION['aviso'] ?? '';
        unset($_SESSION['aviso']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrf_valido()) {
                $error = 'La sesión expiró. Intenta de nuevo.';
            } else {
                $u = Usuario::porLogin(trim($_POST['usuario'] ?? ''));
                if ($u && password_verify($_POST['password'] ?? '', $u['password_hash'])) {
                    session_regenerate_id(true);
                    $_SESSION['uid'] = (int)$u['id'];
                    ir('inicio');
                }
                $error = 'Usuario o contraseña incorrectos.';
            }
        }
        $this->vista('login', ['titulo' => 'Iniciar sesión', 'error' => $error, 'aviso' => $aviso], true);
    }

    public function registro(): void {
        if (!empty($_SESSION['uid'])) ir('inicio');
        $errores = [];
        $v = ['nombre' => '', 'usuario' => '', 'correo' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $v = ['nombre' => trim($_POST['nombre'] ?? ''), 'usuario' => trim($_POST['usuario'] ?? ''), 'correo' => trim($_POST['correo'] ?? '')];
            $pass  = $_POST['password'] ?? '';
            $pass2 = $_POST['password2'] ?? '';

            if (!csrf_valido()) $errores[] = 'La sesión expiró. Intenta de nuevo.';
            if (mb_strlen($v['nombre']) < 2 || mb_strlen($v['nombre']) > 100) $errores[] = 'Escribe tu nombre completo.';
            if (!preg_match('/^[A-Za-z0-9_.-]{3,30}$/', $v['usuario'])) $errores[] = 'El usuario debe tener de 3 a 30 caracteres (letras, números, punto, guion o guion bajo).';
            if (!filter_var($v['correo'], FILTER_VALIDATE_EMAIL) || strlen($v['correo']) > 120) $errores[] = 'El correo no es válido.';
            if (strlen($pass) < 8) $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
            if ($pass !== $pass2) $errores[] = 'Las contraseñas no coinciden.';

            if (!$errores) {
                foreach (Usuario::existentes($v['usuario'], $v['correo']) as $f) {
                    if (strcasecmp($f['usuario'], $v['usuario']) === 0) $errores[] = 'Ese usuario ya existe.';
                    if (strcasecmp($f['correo'], $v['correo']) === 0)   $errores[] = 'Ese correo ya está registrado.';
                }
            }
            if (!$errores) {
                Usuario::crear($v['nombre'], $v['usuario'], $v['correo'], $pass);
                $_SESSION['aviso'] = '¡Cuenta creada! Ya puedes iniciar sesión.';
                ir('login');
            }
        }
        $this->vista('registro', ['titulo' => 'Crear cuenta', 'errores' => $errores, 'v' => $v], true);
    }

    public function logout(): void {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
        ir('portada');
    }
}
