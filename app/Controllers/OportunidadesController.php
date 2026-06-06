<?php
class OportunidadesController extends Controller {
    public function index(): void {
        $boletines = Oportunidad::getBoletines();
        $cursos    = Oportunidad::getCursos();
        $empleos   = Oportunidad::getEmpleos();
        $this->view('oportunidades.index', [
            'title'    => t('title.oportunidades'),
            'page'     => 'oportunidades',
            'boletines'=> $boletines,
            'cursos'   => $cursos,
            'empleos'  => $empleos,
        ]);
    }
}
