<?php
// Basic front controller
require_once __DIR__ . '/inc/autoload.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerClass = 'Controller\\' . ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/Controller/' . ucfirst($controller) . 'Controller.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo 'Controller not found';
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerClass)) {
    http_response_code(500);
    echo 'Controller class missing';
    exit;
}

$instance = new $controllerClass();

if (!method_exists($instance, $action)) {
    http_response_code(404);
    echo 'Action not found';
    exit;
}

$instance->$action();
