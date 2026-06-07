<?php
class Solucion {
    public static function getAll(): array {
        $cdn = CDN;
        return [
            [
                'slug'       => 'consumibles',
                'titulo'     => t('sol.consumibles'),
                'desc'       => t('sol.consumibles.desc'),
                'img'        => "{$cdn}/2025/09/5.jpg",
                'alt'        => t('sol.consumibles'),
                'cta_tienda' => SITE_TIENDA,
            ],
            [
                'slug'       => 'motores',
                'titulo'     => t('sol.motores'),
                'desc'       => t('sol.motores.desc'),
                'img'        => "{$cdn}/2021/08/6.jpg",
                'alt'        => t('sol.motores'),
                'cta_tienda' => null,
            ],
            [
                'slug'       => 'grupos',
                'titulo'     => t('sol.grupos'),
                'desc'       => t('sol.grupos.desc'),
                'img'        => "{$cdn}/2025/10/7.jpg",
                'alt'        => t('sol.grupos'),
                'cta_tienda' => null,
            ],
            [
                'slug'       => 'excavadoras',
                'titulo'     => t('sol.excavadoras'),
                'desc'       => t('sol.excavadoras.desc'),
                'img'        => "{$cdn}/2025/10/9.jpg",
                'alt'        => t('sol.excavadoras'),
                'cta_tienda' => null,
            ],
        ];
    }
}
