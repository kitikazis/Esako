<?php
class Oportunidad {
    /** Boletines / promociones. La oferta destacada usa un GIF animado de muestra. */
    public static function getBoletines(): array {
        $cdn = CDN;
        return [
            ['titulo'=>t('op.b1'), 'img'=>View::asset('img/motor-diesel-4t.gif'), 'destacado'=>true, 'media'=>'gif'],
            ['titulo'=>t('op.b2'), 'img'=>"{$cdn}/2025/10/4-2.jpg"],
            ['titulo'=>t('op.b3'), 'img'=>"{$cdn}/2025/09/5.jpg"],
            ['titulo'=>t('op.b4'), 'img'=>"{$cdn}/2025/10/2-4.jpg"],
            ['titulo'=>t('op.b5'), 'img'=>"{$cdn}/2025/10/3-3.jpg"],
            ['titulo'=>t('op.b6'), 'img'=>"{$cdn}/2025/10/9-1.jpg"],
            ['titulo'=>t('op.b7'), 'img'=>"{$cdn}/2025/10/8-1.jpg"],
            ['titulo'=>t('op.b8'), 'img'=>"{$cdn}/2025/10/4-3.jpg"],
            ['titulo'=>t('op.b9'), 'img'=>"{$cdn}/2025/10/1-2.jpg"],
        ];
    }

    /** Cursos. El primero incluye un video de muestra (abre el canal de YouTube). */
    public static function getCursos(): array {
        $cdn = CDN;
        return [
            [
                'titulo' => t('op.c1'),
                'img'    => "{$cdn}/2025/10/9.jpg",
                'desc'   => t('op.c1.desc'),
                'dur'    => t('op.c1.dur'),
                'mod'    => t('op.c1.mod'),
                'video'  => SITE_YT,
            ],
            [
                'titulo' => t('op.c2'),
                'img'    => "{$cdn}/2025/10/1-4.jpg",
                'desc'   => t('op.c2.desc'),
                'dur'    => t('op.c2.dur'),
                'mod'    => t('op.c2.mod'),
            ],
            [
                'titulo' => t('op.c3'),
                'img'    => "{$cdn}/2025/10/4-2.jpg",
                'desc'   => t('op.c3.desc'),
                'dur'    => t('op.c3.dur'),
                'mod'    => t('op.c3.mod'),
            ],
        ];
    }

    public static function getEmpleos(): array {
        return [
            ['titulo'=>t('op.e1'), 'sede'=>'Lima',     'mod'=>t('op.mod.presencial'), 'tipo'=>t('op.tipo.practica'), 'email'=>SITE_EMAIL],
            ['titulo'=>t('op.e2'), 'sede'=>'Lima',     'mod'=>t('op.mod.presencial'), 'tipo'=>t('op.tipo.full'),     'email'=>SITE_EMAIL],
            ['titulo'=>t('op.e3'), 'sede'=>'Chimbote', 'mod'=>t('op.mod.presencial'), 'tipo'=>t('op.tipo.full'),     'email'=>SITE_EMAIL],
            ['titulo'=>t('op.e4'), 'sede'=>'Chimbote', 'mod'=>t('op.mod.presencial'), 'tipo'=>t('op.tipo.full'),     'email'=>SITE_EMAIL],
        ];
    }
}
