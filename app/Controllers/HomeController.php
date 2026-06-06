<?php
class HomeController extends Controller {
    public function index(): void {
        $slides = Servicio::getSlideImages();
        $servicios = Servicio::getAll();
        $this->view('home.index', [
            'title'    => t('title.inicio'),
            'page'     => 'inicio',
            'slides'   => $slides,
            'servicios'=> $servicios,
        ]);
    }
}
