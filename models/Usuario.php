<?php
class Usuario
{
    public static function porId(int $id): ?array {
        $q = Conexion::get()->prepare('SELECT * FROM usuarios WHERE id = ?');
        $q->execute([$id]);
        return $q->fetch() ?: null;
    }

    public static function porLogin(string $login): ?array {
        $q = Conexion::get()->prepare('SELECT id, password_hash FROM usuarios WHERE usuario = ? OR correo = ? LIMIT 1');
        $q->execute([$login, $login]);
        return $q->fetch() ?: null;
    }

    public static function existentes(string $usuario, string $correo): array {
        $q = Conexion::get()->prepare('SELECT usuario, correo FROM usuarios WHERE usuario = ? OR correo = ?');
        $q->execute([$usuario, $correo]);
        return $q->fetchAll();
    }

    public static function crear(string $nombre, string $usuario, string $correo, string $password): void {
        Conexion::get()->prepare('INSERT INTO usuarios (nombre, usuario, correo, password_hash) VALUES (?, ?, ?, ?)')
            ->execute([$nombre, $usuario, $correo, password_hash($password, PASSWORD_DEFAULT)]);
    }

    /** Si pasó más de un día sin actividad, la racha se perdió. */
    public static function rachaEfectiva(array $u): int {
        if (!$u['ultima_actividad']) return 0;
        $dias = (new DateTime('today'))->diff(new DateTime($u['ultima_actividad']))->days;
        return $dias <= 1 ? (int)$u['racha'] : 0;
    }

    public static function otorgarPuntos(int $uid, int $pts, string $desc): void {
        $db   = Conexion::get();
        $hoy  = date('Y-m-d');
        $ayer = date('Y-m-d', strtotime('-1 day'));
        $db->prepare('UPDATE usuarios SET puntos = puntos + ?,
                      racha = CASE WHEN ultima_actividad = ? THEN racha WHEN ultima_actividad = ? THEN racha + 1 ELSE 1 END,
                      ultima_actividad = ? WHERE id = ?')->execute([$pts, $hoy, $ayer, $hoy, $uid]);
        $db->prepare('INSERT INTO actividad (usuario_id, descripcion, puntos) VALUES (?, ?, ?)')->execute([$uid, $desc, $pts]);
    }
}
