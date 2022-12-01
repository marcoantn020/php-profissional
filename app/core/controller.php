<?php

function controller($matchedUri, $params)
{
    list($controller, $method) = explode("@",array_values($matchedUri)[0]);

    $controllerWithNamespace = CONTROLLER_PATH . $controller;
    if(!class_exists($controllerWithNamespace)) {
        throw new \RuntimeException("Controller {$controller} não existe.");
    }

    $controllerInstance = new $controllerWithNamespace();

    if(!method_exists($controllerInstance, $method)) {
        throw new \RuntimeException("O metodo {$method} não existe no controller {$controller}.");
    }

    $controllerInstance->$method($params);
}