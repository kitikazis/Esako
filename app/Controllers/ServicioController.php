<?php
class ServicioController extends Controller {
    public function index(): void {
        $this->view('servicio.index', [
            'title'   => t('title.servicio'),
            'page'    => 'servicio',
            'paneles' => Servicio::getPaneles(),
            'grid'    => Servicio::getAll(),
        ]);
    }
}
