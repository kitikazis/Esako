<?php
class TiendaController extends Controller {
    public function index(): void {
        $this->view('tienda.index', [
            'title'      => t('shop.title') . ' – Esako Global SAC',
            'page'       => 'tienda',
            'categorias' => Producto::getCategorias(),
            'productos'  => Producto::getProductos(),
        ]);
    }
}
