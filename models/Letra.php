<?php
class Letra
{
    /** Letras agrupadas: vocales, vocales quebradas y consonantes (abecedario). */
    public static function agrupadas(): array {
        $grupos = ['vocal' => [], 'vocal_quebrada' => [], 'consonante' => []];
        foreach (Conexion::get()->query('SELECT letra, tipo, ejemplo_yokotan, ejemplo_espanol, audio FROM letras ORDER BY orden') as $l) {
            $grupos[$l['tipo']][] = $l;
        }
        return $grupos;
    }
}