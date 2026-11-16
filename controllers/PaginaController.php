<?php
/** Secciones que aún están en construcción. */
class PaginaController extends Controlador
{
    public function abecedario(): void { $this->vista('proximamente', ['titulo' => 'Abecedario y Vocales', 'activa' => 'abecedario']); }
    public function perfil(): void     { $this->vista('proximamente', ['titulo' => 'Perfil', 'activa' => 'perfil']); }
}
