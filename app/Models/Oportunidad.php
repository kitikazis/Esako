<?php
class Oportunidad {
    public static function getBoletines(): array {
        $cdn = CDN;
        return [
            ['titulo'=>t('op.b1'), 'img'=>"{$cdn}/2025/10/1-4.jpg"],
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

    public static function getCursos(): array {
        $cdn = CDN;
        return [
            ['titulo'=>t('op.c1'), 'img'=>"{$cdn}/2025/10/9.jpg"],
        ];
    }

    public static function getEmpleos(): array {
        return [
            ['titulo'=>t('op.e1'), 'email'=>SITE_EMAIL],
            ['titulo'=>t('op.e2'), 'email'=>SITE_EMAIL],
            ['titulo'=>t('op.e3'), 'email'=>SITE_EMAIL],
        ];
    }
}
