<?php
class LeccionesController extends Controlador
{
    private const ICONOS = ['escucha' => '🎧', 'memorama' => '🃏', 'escritura' => '✍️', 'lectura' => '📖'];

    /** Mapa de niveles y lecciones. */
    public function mapa(): void {
        $usuario = $this->usuario();
        $uid     = (int)$usuario['id'];
        $niveles = Nivel::estados($uid);
        $actual  = Nivel::actual($niveles);

        $nivel = (int)($_GET['nivel'] ?? 0);
        if (!isset($niveles[$nivel])) $nivel = $actual;
        if (!$niveles[$nivel]['desbloqueado']) {
            $_SESSION['aviso'] = 'Completa el nivel ' . ($nivel - 1) . ' para desbloquear el nivel ' . $nivel . '.';
            ir('lecciones', ['nivel' => $actual]);
        }
        $aviso = $_SESSION['aviso'] ?? '';
        unset($_SESSION['aviso']);

        $nv = $niveles[$nivel];
        if ($nivel < 4) {
            $nodos = array_map(fn($f) => ['href' => url('actividad', ['leccion' => $f['id']]), 'titulo' => $f['titulo'], 'hecha' => (bool)$f['hecha']], Leccion::delNivel($nivel, $uid));
        } else {
            $nodos = array_map(fn($f) => ['href' => url('actividad', ['cuento' => $f['id']]), 'titulo' => $f['titulo'], 'hecha' => (bool)$f['hecha']], Cuento::todos($uid));
        }
        $this->vista('lecciones', [
            'titulo' => 'Lecciones', 'activa' => 'lecciones', 'usuario' => $usuario,
            'niveles' => $niveles, 'nivel' => $nivel, 'nv' => $nv, 'nodos' => $nodos, 'aviso' => $aviso,
            'pct' => $nv['total'] ? (int)round($nv['hechas'] * 100 / $nv['total']) : 0, 'iconos' => self::ICONOS,
        ]);
    }

    /** Abre la actividad: ?leccion=ID (niveles 1-3) o ?cuento=ID (nivel 4). */
    public function actividad(): void {
        $usuario = $this->usuario();
        $niveles = Nivel::estados((int)$usuario['id']);
        $d = ['titulo' => 'Lecciones', 'activa' => 'lecciones', 'usuario' => $usuario, 'scripts' => []];

        if (isset($_GET['cuento'])) {
            $cuento = Cuento::porId((int)$_GET['cuento']);
            if (!$cuento || !$niveles[4]['desbloqueado']) ir('lecciones');
            $pagina = 'cuentos';
            $d += ['cuento' => $cuento, 'dic' => Cuento::diccionario((int)$cuento['id']), 'yaLeido' => Cuento::leido((int)$usuario['id'], (int)$cuento['id'])];
        } else {
            $leccion = Leccion::porId((int)($_GET['leccion'] ?? 0));
            if (!$leccion || !$niveles[(int)$leccion['nivel_id']]['desbloqueado']) ir('lecciones');
            $cat = (int)$leccion['categoria_id'];
            $d['leccion'] = $leccion;
            switch ($leccion['tipo']) {
                case 'escucha':   $pagina = 'escucha';   $d['palabras'] = Palabra::deCategoria($cat); break;
                case 'memorama':  $pagina = 'memorama';  $d['pares'] = Palabra::pares($cat); $d['scripts'][] = 'resources/js/memorama.js'; break;
                case 'escritura': $pagina = 'escritura'; $d['frases'] = Palabra::frases($cat); $d['scripts'][] = 'resources/js/escritura.js'; break;
                default: ir('lecciones');
            }
        }
        $this->vista($pagina, $d);
    }

    /** Recibe el "Terminar" de cada actividad, guarda el progreso y da puntos solo la primera vez. */
    public function completar(): void {
        $usuario = $this->usuario();
        $uid = (int)$usuario['id'];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_valido()) ir('lecciones');
        $niveles = Nivel::estados($uid);

        if (!empty($_POST['leccion_id'])) {
            $l = Leccion::porId((int)$_POST['leccion_id']);
            if (!$l || !$niveles[(int)$l['nivel_id']]['desbloqueado']) ir('lecciones');
            $r = ['nombre' => $l['titulo'], 'nivel' => (int)$l['nivel_id'], 'puntos' => Leccion::completar($uid, $l)];
        } elseif (!empty($_POST['cuento_id'])) {
            $c = Cuento::porId((int)$_POST['cuento_id']);
            if (!$c || !$niveles[4]['desbloqueado']) ir('lecciones');
            $r = ['nombre' => $c['titulo'], 'nivel' => 4, 'puntos' => Cuento::marcarLeido($uid, $c)];
        } else {
            ir('lecciones');
        }
        $_SESSION['resultado'] = $r;
        ir('resultados');
    }

    public function resultados(): void {
        $usuario = $this->usuario();
        $r = $_SESSION['resultado'] ?? null;
        unset($_SESSION['resultado']);
        if (!$r) ir('lecciones');

        $niveles = Nivel::estados((int)$usuario['id']);
        $desbloqueo = ($r['puntos'] > 0 && $niveles[$r['nivel']]['completo'] && isset($niveles[$r['nivel'] + 1])) ? $r['nivel'] + 1 : null;
        $this->vista('resultados', ['titulo' => 'Resultados', 'activa' => 'lecciones', 'usuario' => $usuario, 'r' => $r, 'desbloqueo' => $desbloqueo]);
    }
}
