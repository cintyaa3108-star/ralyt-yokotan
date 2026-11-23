<?php
class Palabra
{
    public static function deCategoria(int $cat): array {
        // Incluye las subcategorías de la categoría (si tiene)
        $q = Conexion::get()->prepare('SELECT p.id, p.yokotan, p.espanol, p.audio, p.imagen
                                       FROM palabras p JOIN categorias c ON c.id = p.categoria_id
                                       WHERE c.id = ? OR c.padre_id = ? ORDER BY c.orden, p.orden');
        $q->execute([$cat, $cat]);
        return $q->fetchAll();
    }

    /** Parejas al azar para el memorama. */
    public static function pares(int $cat, int $cuantas = 6): array {
        $q = Conexion::get()->prepare('SELECT p.id, p.yokotan, p.espanol
                                       FROM palabras p JOIN categorias c ON c.id = p.categoria_id
                                       WHERE c.id = ? OR c.padre_id = ? ORDER BY RAND() LIMIT ' . $cuantas);
        $q->execute([$cat, $cat]);
        return $q->fetchAll();
    }

    /** Frases de la categoría (con 2 o más palabras, para poder ordenarlas). */
    public static function frases(int $cat): array {
        $q = Conexion::get()->prepare("SELECT p.yokotan, p.espanol, p.audio
                                       FROM palabras p JOIN categorias c ON c.id = p.categoria_id
                                       WHERE (c.id = ? OR c.padre_id = ?) AND p.tipo = 'frase' ORDER BY c.orden, p.orden");
        $q->execute([$cat, $cat]);
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