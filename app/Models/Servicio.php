<?php
class Servicio {
    /** Imágenes del hero slider */
    public static function getSlideImages(): array {
        $cdn = CDN;
        // Imágenes HD locales (1920px) de uso libre — ver public/img/banner/CREDITS.txt
        return [
            View::asset('img/banner/excavadora.jpg'),
            View::asset('img/banner/motor.jpg'),
            View::asset('img/banner/grupo.jpg'),
        ];
    }

    /** Grilla de 12 servicios en la homepage */
    public static function getAll(): array {
        $cdn = CDN;
        return [
            ['num'=>1,  'titulo'=>t('svc.g1'),  'img'=>"{$cdn}/2025/10/1-4.jpg"],
            ['num'=>2,  'titulo'=>t('svc.g2'),  'img'=>"{$cdn}/2025/10/2-4.jpg"],
            ['num'=>3,  'titulo'=>t('svc.g3'),  'img'=>"{$cdn}/2025/10/3-3.jpg"],
            ['num'=>4,  'titulo'=>t('svc.g4'),  'img'=>"{$cdn}/2025/10/4-3.jpg"],
            ['num'=>5,  'titulo'=>t('svc.g5'),  'img'=>"{$cdn}/2025/10/1-2.jpg"],
            ['num'=>6,  'titulo'=>t('svc.g6'),  'img'=>"{$cdn}/2025/09/5.jpg"],
            ['num'=>7,  'titulo'=>t('svc.g7'),  'img'=>"{$cdn}/2025/10/4-2.jpg"],
            ['num'=>8,  'titulo'=>t('svc.g8'),  'img'=>"{$cdn}/2025/10/9.jpg"],
            ['num'=>9,  'titulo'=>t('svc.g9'),  'img'=>"{$cdn}/2021/08/6.jpg"],
            ['num'=>10, 'titulo'=>t('svc.g10'), 'img'=>"{$cdn}/2025/10/7.jpg"],
            ['num'=>11, 'titulo'=>t('svc.g11'), 'img'=>"{$cdn}/2025/10/8-1.jpg"],
            ['num'=>12, 'titulo'=>t('svc.g12'), 'img'=>"{$cdn}/2025/10/9-1.jpg"],
        ];
    }

    /** Imágenes circulares de sectores (página Empresa) */
    public static function getSectores(): array {
        $cdn = CDN;
        return [
            ['label'=>t('sec.mineria'),      'img'=>"{$cdn}/2025/10/9.jpg"],
            ['label'=>t('sec.pesca'),        'img'=>"{$cdn}/2021/08/6.jpg"],
            ['label'=>t('sec.agro'),         'img'=>"{$cdn}/2025/10/3-3.jpg"],
            ['label'=>t('sec.construccion'), 'img'=>"{$cdn}/2025/10/4-3.jpg"],
            ['label'=>t('sec.automotriz'),   'img'=>"{$cdn}/2025/10/1-4.jpg"],
            ['label'=>t('sec.petroleo'),     'img'=>"{$cdn}/2025/10/9-1.jpg"],
        ];
    }

    /** Paneles de la página Servicio */
    public static function getPaneles(): array {
        $cdn = CDN;
        return [
            [
                'titulo' => t('svc.panel1'),
                'img'    => "{$cdn}/2025/10/2-4.jpg",
                'alt'    => t('svc.panel1'),
            ],
            [
                'titulo' => t('svc.panel2'),
                'img'    => "{$cdn}/2025/10/7.jpg",
                'alt'    => t('svc.panel2'),
            ],
        ];
    }
}
