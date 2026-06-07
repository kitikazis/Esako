<?php
class Solucion {
    public static function getAll(): array {
        $cdn = CDN;
        return [
            [
                'slug'        => 'consumibles',
                'titulo'      => t('sol.consumibles'),
                'img'         => "{$cdn}/2025/09/5.jpg",
                'alt'         => t('sol.consumibles'),
                'cta_wa'      => View::wa(SITE_WA_PHONE_SOL, t('wa.msg.sol')),
                'cta_tienda'  => SITE_TIENDA,
            ],
            [
                'slug'   => 'motores',
                'titulo' => t('sol.motores'),
                'img'    => "{$cdn}/2021/08/6.jpg",
                'alt'    => t('sol.motores'),
                'cta_wa' => null, 'cta_tienda' => null,
            ],
            [
                'slug'   => 'grupos',
                'titulo' => t('sol.grupos'),
                'img'    => "{$cdn}/2025/10/7.jpg",
                'alt'    => t('sol.grupos'),
                'cta_wa' => null, 'cta_tienda' => null,
            ],
            [
                'slug'   => 'excavadoras',
                'titulo' => t('sol.excavadoras'),
                'img'    => "{$cdn}/2025/10/9.jpg",
                'alt'    => t('sol.excavadoras'),
                'cta_wa' => null, 'cta_tienda' => null,
            ],
        ];
    }
}
