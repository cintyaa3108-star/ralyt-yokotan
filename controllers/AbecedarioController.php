<?php
class AbecedarioController extends Controlador
{
    public function index(): void {
        $g = Letra::agrupadas();
        $this->vista('abecedario', [
            'titulo' => 'Abecedario y Vocales', 'activa' => 'abecedario',
            'vocales' => $g['vocal'], 'quebradas' => $g['vocal_quebrada'], 'consonantes' => $g['consonante'],
            'scripts' => ['resources/js/abecedario.js'],
        ]);
    }
}