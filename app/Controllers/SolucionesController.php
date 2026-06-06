<?php
class SolucionesController extends Controller {
    public function index(): void {
        $soluciones = Solucion::getAll();
        $this->view('soluciones.index', [
            'title'     => t('title.soluciones'),
            'page'      => 'soluciones',
            'soluciones'=> $soluciones,
        ]);
    }
}
