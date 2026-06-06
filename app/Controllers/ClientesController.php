<?php
class ClientesController extends Controller {
    public function index(): void {
        $this->view('clientes.index', [
            'title' => t('title.clientes'),
            'page'  => 'clientes',
        ]);
    }
}
