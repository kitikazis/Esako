<?php
class Producto {
    /** Categorías de la tienda (slug + etiqueta traducible). */
    public static function getCategorias(): array {
        return [
            ['slug' => 'automotriz',    'label' => t('sec.automotriz')],
            ['slug' => 'mineria',       'label' => t('sec.mineria')],
            ['slug' => 'agroindustria', 'label' => t('sec.agro')],
            ['slug' => 'pesca',         'label' => t('sec.pesca')],
            ['slug' => 'construccion',  'label' => t('sec.construccion')],
            ['slug' => 'petroleo',      'label' => t('sec.petroleo')],
            ['slug' => 'equipos',       'label' => t('shop.cat.equipos')],
        ];
    }

    /**
     * Productos de muestra. Reemplazar por los reales (idealmente desde una
     * base de datos o el catálogo de WooCommerce). 'icon' define el ícono.
     */
    public static function getProductos(): array {
        return [
            ['nombre'=>'Aceite de Motor Diésel 15W-40', 'cats'=>['Automotriz','Construcción','Minería'], 'precio'=>340, 'icon'=>'oil'],
            ['nombre'=>'Aceite de Motor Diésel 25W-60', 'cats'=>['Automotriz','Minería'],                'precio'=>360, 'icon'=>'oil'],
            ['nombre'=>'Refrigerante de Motor Diésel',  'cats'=>['Automotriz','Construcción'],            'precio'=>52,  'icon'=>'coolant'],
            ['nombre'=>'Filtro Separador Agua / Combustible', 'cats'=>['Automotriz','Construcción'],      'precio'=>55,  'icon'=>'filter'],
            ['nombre'=>'Base de Filtro Separador',      'cats'=>['Automotriz','Construcción'],            'precio'=>350, 'icon'=>'filter'],
            ['nombre'=>'Filtro de Aceite',              'cats'=>['Automotriz','Minería'],                 'precio'=>45,  'icon'=>'filter'],
            ['nombre'=>'Empaque de Cubiertas',          'cats'=>['Automotriz','Construcción'],            'precio'=>115, 'icon'=>'gasket'],
            ['nombre'=>'Manguera Hidráulica',           'cats'=>['Construcción','Minería'],               'precio'=>120, 'icon'=>'hose'],
            ['nombre'=>'Grasa Industrial Multiuso',     'cats'=>['Minería','Construcción','Pesca'],       'precio'=>38,  'icon'=>'grease'],
            ['nombre'=>'Aceite Hidráulico ISO 68',      'cats'=>['Construcción','Minería'],               'precio'=>290, 'icon'=>'oil'],
            ['nombre'=>'Kit de Mantenimiento Motor',    'cats'=>['Automotriz','Minería'],                 'precio'=>520, 'icon'=>'kit'],
            ['nombre'=>'Bomba de Combustible',          'cats'=>['Automotriz','Petróleo'],                'precio'=>480, 'icon'=>'pump'],
        ];
    }
}
