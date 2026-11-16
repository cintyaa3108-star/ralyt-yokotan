<?php
class Leccion
{
    public static function porId(int $id): ?array {
        $q = Conexion::get()->prepare('SELECT l.*, n.tipo FROM lecciones l JOIN niveles n ON n.id = l.nivel_id WHERE l.id = ?');
        $q->execute([$id]);
        return $q->fetch() ?: null;
    }

    /** Lecciones de un nivel con su estado para el usuario. */
    public static function delNivel(int $nivel, int $uid): array {
        $q = Conexion::get()->prepare('SELECT l.id, l.titulo, COALESCE(p.completada, 0) AS hecha
                                       FROM lecciones l LEFT JOIN progreso p ON p.leccion_id = l.id AND p.usuario_id = ?
                                       WHERE l.nivel_id = ? ORDER BY l.orden');
        $q->execute([$uid, $nivel]);
        return $q->fetchAll();
    }

    /** Marca la lección y da puntos solo la primera vez. Devuelve los puntos otorgados (0 si ya estaba hecha). */
    public static function completar(int $uid, array $leccion): int {
        $db = Conexion::get();
        $q = $db->prepare('SELECT completada FROM progreso WHERE usuario_id = ? AND leccion_id = ?');
        $q->execute([$uid, $leccion['id']]);
        if ($q->fetchColumn()) return 0;

        $pts = PUNTOS[(int)$leccion['nivel_id']];
        $db->prepare('INSERT INTO progreso (usuario_id, leccion_id, completada, puntos, completada_en) VALUES (?, ?, 1, ?, NOW())
                      ON DUPLICATE KEY UPDATE completada = 1, puntos = VALUES(puntos), completada_en = NOW()')
           ->execute([$uid, $leccion['id'], $pts]);
        Usuario::otorgarPuntos($uid, $pts, 'Nivel ' . $leccion['nivel_id'] . ': ' . $leccion['titulo']);
        return $pts;
    }
}
