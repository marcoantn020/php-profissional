<?php

function exactMatchUriInArrayRoutes($uri, $routes)
{
    return (array_key_exists($uri, $routes)) ? [$uri => $routes[$uri]] : [];
}

function regularExpressionMatchArrayRoutes($routes, $uri)
{
    return array_filter(
        $routes,
        static function ($value) use ($uri) {
            $regex = str_replace("/", "\/", ltrim($value, "/"));
            return preg_match("/^$regex$/", ltrim($uri, "/"));
        },
        ARRAY_FILTER_USE_KEY
    );
}

function params($matchedUriExpressionMatch, $uri)
{
    if (!empty($matchedUriExpressionMatch)) {
        $matchedToGetParams = array_keys($matchedUriExpressionMatch)[0];
        return array_diff(
            $uri,
            explode("/", ltrim($matchedToGetParams, "/"))
        );
    }
    return [];
}

function formatParamsData($uri, $params)
{
    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }
    return $paramsData;
}

/**
 * @throws Exception
 */
function router ()
{
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    $routes = require "routes.php";
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes[$requestMethod]);

    $paramsData = [];
    if(empty($matchedUri)) {
        $matchedUri = regularExpressionMatchArrayRoutes($routes[$requestMethod], $uri);
        $uri = explode("/", ltrim($uri, "/"));
        $params = params($matchedUri, $uri);
        $paramsData = formatParamsData($uri, $params);
    }

    if(!empty($matchedUri)) {
        return controller($matchedUri, $paramsData);
    }

    throw new \RuntimeException("Algo deu errado.");

}






