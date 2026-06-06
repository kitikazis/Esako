# Esako Global SAC — PHP MVC

## Requisitos
- PHP >= 8.1
- mod_rewrite habilitado (Apache) o equivalente (Nginx)

## Instalación rápida (Apache / XAMPP / Laragon)

1. Copia la carpeta `mvc/` a tu servidor (p.ej. `htdocs/esako/`).
2. Ajusta `BASE_URL` en `index.php` si el proyecto no está en la raíz:
   ```php
   define('BASE_URL', '/esako'); // subfolder
   ```
3. Asegúrate de que el .htaccess sea leído (`AllowOverride All`).
4. Abre http://localhost/esako/ en el navegador.

## Estructura del proyecto

```
mvc/
├── index.php           ← Front controller
├── .htaccess           ← URL rewriting
├── config/
│   └── config.php      ← Constantes globales (URLs, emails)
├── core/
│   ├── Router.php      ← Enrutador de URLs
│   ├── Controller.php  ← Controlador base
│   └── View.php        ← Helper para vistas y parciales
├── app/
│   ├── Controllers/    ← Un controlador por página
│   ├── Models/         ← Datos/lógica (actualmente estáticos)
│   └── Views/
│       ├── layouts/    ← Layout principal (main.php)
│       ├── partials/   ← header.php, sidebar.php
│       └── */          ← Una carpeta por página
└── public/
    ├── css/            ← Hojas de estilo
    └── js/             ← Scripts

```

## Agregar una nueva página

1. Crear `app/Controllers/NombreController.php` extendiendo `Controller`.
2. Crear `app/Views/nombre/index.php` con el HTML de la vista.
3. Registrar la ruta en `index.php`:
   ```php
   $router->get('/nombre', 'NombreController', 'index');
   ```

## Conectar base de datos

Agrega en `config/config.php`:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'esako');
define('DB_USER', 'root');
define('DB_PASS', '');
```
Crea una clase `Database` en `core/Database.php` con PDO y úsala en los modelos.
