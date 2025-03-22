<?php
require_once 'Libraries/Core/Autoload.php';

$controller = ucwords($controller);
$controllerFile = "Controllers/{$controller}.php";

if (file_exists($controllerFile)) {
    require_once($controllerFile);

    // Cargar servicio dinámico
    $serviceClass = "{$controller}Service";
    $serviceFile = "Services/{$serviceClass}.php";
    if (file_exists($serviceFile)) {
        require_once($serviceFile);
        $serviceInstance = new $serviceClass();
    } else {
        $serviceInstance = null;
    }

    // Crear instancia del controlador con el servicio inyectado
    $controllerInstance = new $controller($serviceInstance);

    
    if (method_exists($controllerInstance, $method)) {
        $controllerInstance->{$method}($params);
    } else {
        require_once("Controllers/Error.php");
    }
} else {
    require_once("Controllers/Error.php");
}
?>