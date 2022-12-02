<?php

function controller($matchedUri, $params)
{
    [$controller, $method] = explode("@", array_values($matchedUri)[0]);

    $controllerWithNamespace = CONTROLLER_PATH . $controller;
    if(!class_exists($controllerWithNamespace)) {
        throw new \RuntimeException("Controller {$controller} não existe.");
    }

    $controllerInstance = new $controllerWithNamespace();

    if(!method_exists($controllerInstance, $method)) {
        throw new \RuntimeException("O metodo {$method} não existe no controller {$controller}.");
    }

    if(empty($params)) {
        $controller = $controllerInstance->$method();
    } else {
        $controller = $controllerInstance->$method($params);
    }

    if($_SERVER["REQUEST_METHOD"] === 'POST') {
        die();
    }

    return $controller;
}