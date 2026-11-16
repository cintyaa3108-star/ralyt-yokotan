<?php
class Cuento
{
    public static function porId(int $id): ?array {
        $q = Conexion::get()->prepare('SELECT * FROM cuentos WHERE id = ?');
        $q->execute([$id]);
        return $q->fetch() ?: null;
    }

    public static function todos(int $uid): array {
        $q = Conexion::get()->prepare('SELECT c.id, c.titulo, (cl.cuento_id IS NOT NULL) AS hecha
                                       FROM cuentos c LEFT JOIN cuentos_leidos cl ON cl.cuento_id = c.id AND cl.usuario_id = ?
                                       ORDER BY c.id');
        $q->execute([$uid]);
        return $q->fetchAll();
    }

    /** Diccionario palabra → significado para los popovers. */
    public static function diccionario(int $id): array {
        $q = Conexion::get()->prepare('SELECT palabra, significado FROM cuento_palabras WHERE cuento_id = ?');
        $q->execute([$id]);
        $dic = [];
        foreach ($q as $f) { $dic[$f['palabra']] = $f['significado']; $dic[mb_strtolower($f['palabra'])] ??= $f['significado']; }
        return $dic;
    }

    public static function leido(int $uid, int $id): bool {
        $q = Conexion::get()->prepare('SELECT 1 FROM cuentos_leidos WHERE usuario_id = ? AND cuento_id = ?');
        $q->execute([$uid, $id]);
        return (bool)$q->fetchColumn();
    }

    /** Marca como leído y da puntos solo la primera vez. Devuelve los puntos otorgados. */
    public static function marcarLeido(int $uid, array $cuento): int {
        $ins = Conexion::get()->prepare('INSERT IGNORE INTO cuentos_leidos (usuario_id, cuento_id) VALUES (?, ?)');
        $ins->execute([$uid, $cuento['id']]);
        if (!$ins->rowCount()) return 0;
        Usuario::otorgarPuntos($uid, PUNTOS[4], 'Leíste: ' . $cuento['titulo']);
        return PUNTOS[4];
    }
}
