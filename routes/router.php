<?php 

function load(string $controller, string $action)
{
    $controllerNamespace = "escola_php\\controller\\{$controller}";
    if(!class_exists($controllerNamespace)){
        throw new Exception("O controller {$controller} não existe");
    }

    $controllerInstance = new $controllerNamespace();

    if(!method_exists($controllerInstance, $action)){
        throw new Exception("O metodo {$action} não existe no controller {$controller}");
    }

    $controllerInstance->$action();
}

$routes = [
    "GET" => [
        "/" => load("HomeController", "index"),
        "/contact" => load("ContactControlle", "index"),
    ],
    "POST" => [
        "/contact" => load("ContactController", "store"),
    ],
]
?>