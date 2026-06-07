<?php
class View {
    public static function partial(string $partial, array $data = []): void {
        extract($data, EXTR_SKIP);
        $file = VIEWS_PATH . '/partials/' . $partial . '.php';
        if (file_exists($file)) include $file;
    }

    public static function e(mixed $val): string {
        return htmlspecialchars((string)$val, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * URL de un asset de /public con cache busting automático.
     * Añade ?v=<fecha de modificación> para que el navegador descargue
     * la versión nueva cada vez que el archivo cambia (sin Ctrl+F5).
     * Ej: View::asset('css/main.css') -> /public/css/main.css?v=1717700000
     */
    /**
     * Construye un enlace de WhatsApp con mensaje predeterminado.
     * Ej: View::wa(SITE_WA_PHONE, 'Hola...') -> https://wa.me/51...?text=Hola...
     */
    public static function wa(string $phone, string $msg = ''): string {
        $url = 'https://wa.me/' . preg_replace('/\D/', '', $phone);
        if ($msg !== '') {
            $url .= '?text=' . rawurlencode($msg);
        }
        return $url;
    }

    public static function asset(string $path): string {
        $path = ltrim($path, '/');
        $url  = ASSETS_URL . '/' . $path;
        $file = BASE_PATH . '/public/' . $path;
        if (is_file($file)) {
            $url .= '?v=' . filemtime($file);
        }
        return $url;
    }
}
