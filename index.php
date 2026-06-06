<?php
define('BASE_PATH', __DIR__);
define('BASE_URL', '/dashboard/mvc.1');   // subfolder under htdocs

spl_autoload_register(function ($class) {
    $paths = [
        BASE_PATH . '/core/'             . $class . '.php',
        BASE_PATH . '/app/Controllers/' . $class . '.php',
        BASE_PATH . '/app/Models/'      . $class . '.php',
    ];
    foreach ($paths as $p) {
        if (file_exists($p)) { require_once $p; return; }
    }
});

require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/core/Router.php';
require_once BASE_PATH . '/core/Controller.php';
require_once BASE_PATH . '/core/View.php';
require_once BASE_PATH . '/core/Lang.php';

Lang::init();

$router = new Router();

$router->get('/',              'HomeController',        'index');
$router->get('/empresa',       'EmpresaController',     'index');
$router->get('/servicio',      'ServicioController',    'index');
$router->get('/soluciones',    'SolucionesController',  'index');
$router->get('/oportunidades', 'OportunidadesController','index');
$router->get('/clientes',      'ClientesController',    'index');

$url = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');

// Strip the subfolder prefix (BASE_URL) so routes match.
if (BASE_URL !== '' && strpos($url, BASE_URL) === 0) {
    $url = substr($url, strlen(BASE_URL));
}
if ($url === '' || $url === false) { $url = '/'; }

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$router->dispatch($url, $method);
