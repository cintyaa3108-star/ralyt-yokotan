<?php
class Logro
{
    /**
     * Todos los logros con su estado: [emoji, nombre, desbloqueado, descripción].
     * Se calculan con el avance real del usuario (no hay tabla; para agregar uno, añade una línea aquí).
     */
    public static function todos(array $usuario, array $niveles, int $racha): array {
        $hechas = array_sum(array_column($niveles, 'hechas'));
        return [
            ['⭐', 'Principiante', $hechas >= 1,                          'Completa tu primera lección'],
            ['📘', 'Lector',       $niveles[4]['hechas'] >= 1,            'Lee tu primer cuento'],
            ['🔥', 'Racha',        $racha >= 7,                           'Mantén una racha de 7 días'],
            ['🏆', 'Experto',      (int)$usuario['puntos'] >= 500,        'Reúne 500 puntos'],
            ['👑', 'Maestro',      $niveles[4]['completo'],               'Termina todos los niveles'],
            ['🎧', 'Oyente',       $niveles[1]['completo'],               'Completa el nivel 1'],
            ['🃏', 'Memorioso',    $niveles[2]['completo'],               'Completa el nivel 2'],
            ['✍️', 'Escritor',     $niveles[3]['completo'],               'Completa el nivel 3'],
        ];
    }
}