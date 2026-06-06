<?php
class ServicioController extends Controller {
    public function index(): void {
        $servicios = Servicio::getPaneles();
        $this->view('servicio.index', [
            'title'    => t('title.servicio'),
            'page'     => 'servicio',
            'servicios'=> $servicios,
        ]);
    }
}
