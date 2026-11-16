<?php
class RankingController extends Controlador
{
    public function index(): void {
        $usuario = $this->usuario();
        $this->vista('ranking', [
            'titulo' => 'Ranking', 'activa' => 'ranking', 'usuario' => $usuario,
            'top' => Ranking::top(10), 'miPos' => Ranking::posicion((int)$usuario['id']),
        ]);
    }
}
