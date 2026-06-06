<?php
class EmpresaController extends Controller {
    public function index(): void {
        $sectores = Servicio::getSectores();
        $this->view('empresa.index', [
            'title'   => t('title.empresa'),
            'page'    => 'empresa',
            'sectores'=> $sectores,
        ]);
    }
}
