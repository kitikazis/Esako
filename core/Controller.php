<?php
class Controller {
    /**
     * Renders a view inside the main layout.
     * @param string $view   dot-notation path, e.g. "home.index"
     * @param array  $data   variables available in the view
     */
    protected function view(string $view, array $data = []): void {
        extract($data, EXTR_SKIP);
        $viewFile = VIEWS_PATH . '/' . str_replace('.', '/', $view) . '.php';

        ob_start();
        if (!file_exists($viewFile)) {
            echo '<p>Vista no encontrada: ' . htmlspecialchars($viewFile) . '</p>';
        } else {
            include $viewFile;
        }
        $content = ob_get_clean();

        $layoutFile = VIEWS_PATH . '/layouts/main.php';
        include $layoutFile;
    }
}
