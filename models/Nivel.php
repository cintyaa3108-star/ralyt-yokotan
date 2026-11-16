<?php
class Nivel
{
    /** Los 4 niveles con total/hechas/desbloqueado/completo. Un nivel se abre al completar el anterior. */
    public static function estados(int $uid): array {
        $db = Conexion::get();
        $niveles = [];
        foreach ($db->query('SELECT id, nombre, tipo FROM niveles ORDER BY id') as $n) {
            $n['total'] = 0; $n['hechas'] = 0;
            $niveles[(int)$n['id']] = $n;
        }
        $q = $db->prepare('SELECT l.nivel_id, COUNT(*) AS total, SUM(COALESCE(p.completada, 0)) AS hechas
                           FROM lecciones l LEFT JOIN progreso p ON p.leccion_id = l.id AND p.usuario_id = ?
                           GROUP BY l.nivel_id');
        $q->execute([$uid]);
        foreach ($q as $f) {
            $niveles[(int)$f['nivel_id']]['total']  = (int)$f['total'];
            $niveles[(int)$f['nivel_id']]['hechas'] = (int)$f['hechas'];
        }
        // El nivel 4 (lectura) cuenta cuentos, no lecciones
        $niveles[4]['total'] = (int)$db->query('SELECT COUNT(*) FROM cuentos')->fetchColumn();
        $q = $db->prepare('SELECT COUNT(*) FROM cuentos_leidos WHERE usuario_id = ?');
        $q->execute([$uid]);
        $niveles[4]['hechas'] = (int)$q->fetchColumn();

        $anterior = true;
        foreach ($niveles as &$n) {
            $n['completo']     = $n['total'] > 0 && $n['hechas'] >= $n['total'];
            $n['desbloqueado'] = $anterior;
            $anterior          = $n['completo'];
        }
        unset($n);
        return $niveles;
    }

    /** Primer nivel abierto y sin terminar. */
    public static function actual(array $niveles): int {
        foreach ($niveles as $id => $n) if ($n['desbloqueado'] && !$n['completo']) return $id;
        return array_key_last($niveles);
    }
}
