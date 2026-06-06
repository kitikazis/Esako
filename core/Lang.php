<?php
/**
 * Sistema de internacionalización (i18n) — Español / Inglés.
 *
 * - El idioma se elige con ?lang=es|en y se guarda en cookie 1 año.
 * - Si no hay parámetro, usa la cookie; si no, el navegador; si no, 'es'.
 * - Las cadenas viven en config/lang/{es,en}.php
 */
class Lang {
    private static string $lang = 'es';
    private static array  $strings = [];
    public  const SUPPORTED = ['es', 'en'];
    private const DEFAULT    = 'es';

    public static function init(): void {
        $lang = null;

        // 1) ?lang= en la URL (y lo persistimos en cookie)
        if (isset($_GET['lang']) && in_array($_GET['lang'], self::SUPPORTED, true)) {
            $lang = $_GET['lang'];
            setcookie('lang', $lang, [
                'expires'  => time() + 31536000,
                'path'     => '/',
                'samesite' => 'Lax',
            ]);
        }
        // 2) cookie previa
        elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], self::SUPPORTED, true)) {
            $lang = $_COOKIE['lang'];
        }
        // 3) idioma del navegador
        elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $pref = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
            if (in_array($pref, self::SUPPORTED, true)) {
                $lang = $pref;
            }
        }

        self::$lang = $lang ?? self::DEFAULT;

        $file = BASE_PATH . '/config/lang/' . self::$lang . '.php';
        self::$strings = is_file($file) ? require $file : [];
    }

    /** Código de idioma actual ('es' | 'en'). */
    public static function current(): string {
        return self::$lang;
    }

    /** Traduce una clave; si no existe, devuelve $default o la propia clave. */
    public static function t(string $key, ?string $default = null): string {
        return self::$strings[$key] ?? $default ?? $key;
    }
}

/** Atajo global para las vistas: t('clave'). */
function t(string $key, ?string $default = null): string {
    return Lang::t($key, $default);
}
