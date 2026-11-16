<?php
class Palabra
{
    public static function deCategoria(int $cat): array {
        $q = Conexion::get()->prepare('SELECT id, yokotan, espanol, audio, imagen FROM palabras WHERE categoria_id = ? ORDER BY orden');
        $q->execute([$cat]);
        return $q->fetchAll();
    }

    /** Parejas al azar para el memorama. */
    public static function pares(int $cat, int $cuantas = 6): array {
        $q = Conexion::get()->prepare('SELECT id, yokotan, espanol, imagen FROM palabras WHERE categoria_id = ? ORDER BY RAND() LIMIT ' . $cuantas);
        $q->execute([$cat]);
        $pares = $q->fetchAll();
        foreach ($pares as &$p) {
            if (!empty($p['imagen']) && function_exists('ruta_imagen')) {
                $p['imagen'] = ruta_imagen($p['imagen']);
            }
        }
        return $pares;
    }

    /** Frases de la categoría (con 2 o más palabras, para poder ordenarlas). */
    public static function frases(int $cat): array {
        $q = Conexion::get()->prepare("SELECT yokotan, espanol, audio FROM palabras WHERE categoria_id = ? AND tipo = 'frase' ORDER BY orden");
        $q->execute([$cat]);
        $frases = [];
        foreach ($q as $f) {
            if (count(preg_split('/\s+/u', trim($f['yokotan']))) < 2) continue;
            $frases[] = ['yokotan' => trim($f['yokotan']), 'espanol' => $f['espanol'], 'audio' => ruta_audio($f['audio'])];
        }
        return $frases;
    }

    /** Una palabra distinta cada fecha, la misma para todos. */
    public static function delDia(): ?array {
        $db = Conexion::get();
        $n = (int)$db->query("SELECT COUNT(*) FROM palabras WHERE tipo = 'palabra'")->fetchColumn();
        if (!$n) return null;
        $off = crc32(date('Y-m-d')) % $n;
        return $db->query("SELECT yokotan, espanol, audio FROM palabras WHERE tipo = 'palabra' ORDER BY id LIMIT 1 OFFSET $off")->fetch() ?: null;
    }
}
