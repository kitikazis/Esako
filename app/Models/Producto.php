<?php
class Producto {
    /** Categorías de la tienda (slug + etiqueta + imagen representativa). */
    public static function getCategorias(): array {
        $cdn = CDN;
        return [
            ['slug'=>'automotriz',    'label'=>t('sec.automotriz'),   'img'=>"{$cdn}/2025/10/1-4.jpg"],
            ['slug'=>'mineria',       'label'=>t('sec.mineria'),      'img'=>"{$cdn}/2025/10/9.jpg"],
            ['slug'=>'agroindustria', 'label'=>t('sec.agro'),         'img'=>"{$cdn}/2025/10/3-3.jpg"],
            ['slug'=>'pesca',         'label'=>t('sec.pesca'),        'img'=>"{$cdn}/2021/08/6.jpg"],
            ['slug'=>'construccion',  'label'=>t('sec.construccion'), 'img'=>"{$cdn}/2025/10/4-3.jpg"],
            ['slug'=>'petroleo',      'label'=>t('sec.petroleo'),     'img'=>"{$cdn}/2025/10/9-1.jpg"],
            ['slug'=>'equipos',       'label'=>t('shop.cat.equipos'), 'img'=>"{$cdn}/2025/10/7.jpg"],
        ];
    }

    /**
     * Productos de muestra (reemplazar por los reales). 'cats' usa slugs.
     * 'icon' define la imagen de muestra (ver $imgMap en la vista).
     */
    public static function getProductos(): array {
        return [
            ['nombre'=>'Aceite de Motor Diésel 15W-40', 'cats'=>['automotriz','construccion','mineria'], 'precio'=>340, 'icon'=>'oil',
             'desc'=>'Lubricante de alto rendimiento para motores diésel de servicio pesado. Protege contra el desgaste y prolonga la vida del motor.',
             'specs'=>['Viscosidad 15W-40','Presentación 5 galones','Norma API CI-4 / CH-4']],
            ['nombre'=>'Aceite de Motor Diésel 25W-60', 'cats'=>['automotriz','mineria'], 'precio'=>360, 'icon'=>'oil',
             'desc'=>'Aceite mineral para motores diésel que operan en condiciones extremas de carga y temperatura.',
             'specs'=>['Viscosidad 25W-60','Presentación 5 galones','Alta resistencia térmica']],
            ['nombre'=>'Refrigerante de Motor Diésel', 'cats'=>['automotriz','construccion'], 'precio'=>52, 'icon'=>'coolant',
             'desc'=>'Refrigerante anticorrosión que mantiene la temperatura óptima del motor y previene la formación de óxido.',
             'specs'=>['Listo para usar','Protección anticorrosión','Presentación 1 galón']],
            ['nombre'=>'Filtro Separador Agua / Combustible', 'cats'=>['automotriz','construccion'], 'precio'=>55, 'icon'=>'filter',
             'desc'=>'Separa el agua del combustible para proteger el sistema de inyección y evitar fallas costosas.',
             'specs'=>['Alta eficiencia de filtrado','Compatibilidad multimarca','Fácil instalación']],
            ['nombre'=>'Base de Filtro Separador', 'cats'=>['automotriz','construccion'], 'precio'=>350, 'icon'=>'filter',
             'desc'=>'Base metálica para sistema de filtro separador, con conexiones reforzadas para uso industrial.',
             'specs'=>['Construcción reforzada','Conexiones estándar','Uso industrial']],
            ['nombre'=>'Filtro de Aceite', 'cats'=>['automotriz','mineria'], 'precio'=>45, 'icon'=>'filter',
             'desc'=>'Retiene las partículas que dañan el motor, manteniendo el aceite limpio por más tiempo.',
             'specs'=>['Medio filtrante de alta retención','Compatibilidad multimarca','Sello antifuga']],
            ['nombre'=>'Empaque de Cubiertas', 'cats'=>['automotriz','construccion'], 'precio'=>115, 'icon'=>'gasket',
             'desc'=>'Empaque de sellado resistente a altas temperaturas y presión para cubiertas de motor.',
             'specs'=>['Material resistente al calor','Sellado hermético','Larga duración']],
            ['nombre'=>'Manguera Hidráulica', 'cats'=>['construccion','mineria'], 'precio'=>120, 'icon'=>'hose',
             'desc'=>'Manguera de alta presión para sistemas hidráulicos de maquinaria pesada.',
             'specs'=>['Alta presión de trabajo','Refuerzo de acero','Resistente a la abrasión']],
            ['nombre'=>'Grasa Industrial Multiuso', 'cats'=>['mineria','construccion','pesca'], 'precio'=>38, 'icon'=>'grease',
             'desc'=>'Grasa lubricante multiuso para rodamientos y puntos de engrase de equipos industriales.',
             'specs'=>['Resistente al agua','Amplio rango de temperatura','Presentación 1 kg']],
            ['nombre'=>'Aceite Hidráulico ISO 68', 'cats'=>['construccion','mineria'], 'precio'=>290, 'icon'=>'oil',
             'desc'=>'Fluido hidráulico antidesgaste para sistemas de alta exigencia en maquinaria pesada.',
             'specs'=>['Grado ISO VG 68','Antidesgaste','Presentación 5 galones']],
            ['nombre'=>'Kit de Mantenimiento Motor', 'cats'=>['automotriz','mineria'], 'precio'=>520, 'icon'=>'filter',
             'desc'=>'Kit completo de filtros y consumibles para el mantenimiento preventivo de tu motor.',
             'specs'=>['Incluye filtros y empaques','Compatibilidad multimarca','Todo en un solo paquete']],
            ['nombre'=>'Bomba de Combustible', 'cats'=>['automotriz','petroleo'], 'precio'=>480, 'icon'=>'hose',
             'desc'=>'Bomba de alimentación de combustible de alto caudal para motores diésel industriales.',
             'specs'=>['Alto caudal','Construcción robusta','Compatibilidad multimarca']],
            ['nombre'=>'Aceite Agrícola Multiuso', 'cats'=>['agroindustria','automotriz'], 'precio'=>310, 'icon'=>'oil',
             'desc'=>'Lubricante universal para tractores y maquinaria agrícola: motor, transmisión e hidráulico.',
             'specs'=>['Multifuncional (UTTO)','Para tractores y cosechadoras','Presentación 5 galones']],
            ['nombre'=>'Kit de Filtros para Embarcación', 'cats'=>['pesca'], 'precio'=>210, 'icon'=>'filter',
             'desc'=>'Set de filtros para motores marinos: aceite, combustible y separador de agua.',
             'specs'=>['Especial para motor marino','Incluye 3 filtros','Protección anticorrosión']],
            ['nombre'=>'Motor Diésel Marino', 'cats'=>['pesca','equipos'], 'precio'=>2890, 'icon'=>'engine',
             'desc'=>'Motor diésel marino confiable y de bajo consumo para embarcaciones de pesca.',
             'specs'=>['Alta confiabilidad','Bajo consumo de combustible','Repuestos disponibles']],
            ['nombre'=>'Grupo Electrógeno 50 KVA', 'cats'=>['equipos','construccion','mineria'], 'precio'=>2490, 'icon'=>'generator',
             'desc'=>'Grupo electrógeno diésel para respaldo de energía continuo en obras y operaciones.',
             'specs'=>['Potencia 50 KVA','Cabina insonorizada','Arranque automático (ATS) opcional']],
            ['nombre'=>'Excavadora Compacta', 'cats'=>['equipos','construccion'], 'precio'=>2990, 'icon'=>'excavator',
             'desc'=>'Excavadora compacta ideal para espacios reducidos en construcción y obras urbanas.',
             'specs'=>['Compacta y versátil','Bajo consumo','Fácil mantenimiento']],
            ['nombre'=>'Aceite Hidráulico para Petróleo', 'cats'=>['petroleo','mineria'], 'precio'=>320, 'icon'=>'oil',
             'desc'=>'Aceite hidráulico para equipos del sector petrolero, con alta estabilidad química.',
             'specs'=>['Alta estabilidad térmica','Antidesgaste','Presentación 5 galones']],
            ['nombre'=>'Grasa para Maquinaria Pesada', 'cats'=>['mineria','construccion'], 'precio'=>62, 'icon'=>'grease',
             'desc'=>'Grasa de extrema presión (EP) para rodamientos y articulaciones de maquinaria pesada.',
             'specs'=>['Extrema presión (EP2)','Resistente al lavado por agua','Larga duración']],
        ];
    }
}
