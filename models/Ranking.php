<?php
class Ranking
{
    public static function top(int $n = 10): array {
        return Conexion::get()->query('SELECT * FROM v_ranking ORDER BY posicion, id LIMIT ' . $n)->fetchAll();
    }

    public static function posicion(int $uid): int {
        $q = Conexion::get()->prepare('SELECT posicion FROM v_ranking WHERE id = ?');
        $q->execute([$uid]);
        return (int)$q->fetchColumn();
    }
}
