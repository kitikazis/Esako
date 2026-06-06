<?php
class Router {
    private array $routes = [];

    public function get(string $path, string $controller, string $action): void {
        $this->routes[] = compact('path', 'controller', 'action');
    }

    public function dispatch(string $url, string $method): void {
        // Normalise trailing slash
        $url = rtrim($url, '/') ?: '/';

        foreach ($this->routes as $route) {
            $pattern = preg_replace('#/:([a-z_]+)#', '/([^/]+)', $route['path']);
            if (preg_match('#^' . $pattern . '$#', $url, $m)) {
                array_shift($m);
                $ctrl = new $route['controller']();
                $ctrl->{$route['action']}(...$m);
                return;
            }
        }

        http_response_code(404);
        echo '<h1>404 – Página no encontrada</h1>';
    }
}
