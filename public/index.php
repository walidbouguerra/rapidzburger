<?php
session_start();
$_SESSION['errors'] = [];

// Autoloader
spl_autoload_register(function ($class) {
    if (file_exists('../src/controllers/' . $class . '.php')) {
        require '../src/controllers/' . $class . '.php';
    } else if (file_exists('../src/models/' . $class . '.php')) {
        require '../src/models/' . $class . '.php';
    } else if (file_exists($class . '.php')){
        require $class . '.php';
    }
});

// Router
$url = $_GET['url'] ?? null;
$url = explode("/", filter_var($url, FILTER_SANITIZE_URL));

$controller = $url[0] ?? null;
$action = $url[1] ?? null;
$id = $url[2] ?? null;

if (file_exists('../src/controllers/' . $controller . 'Controller.php') && !empty($controller)) {
    $controller .= 'Controller';
    $controller = new $controller();
    if (isset($action)) {
        if (method_exists($controller, $action)) {
            if (isset($id)) {
                $controller->$action($id);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
    } else {
        $controller->index();
    }
} else {
    $controller = new MenuController();
    $controller->index();
}