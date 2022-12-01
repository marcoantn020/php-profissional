<?php

function routes ()
{
   return require "routes.php";
}

function exactMatchUriInArrayRoutes($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        return [$uri => $routes[$uri]];
    }
    return [];
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
            explode("/", ltrim($uri, "/")),
            explode("/", ltrim($matchedToGetParams, "/"))
        );
    }
    return [];
}

function formatParamsData($uri, $params)
{
    $uri = explode("/", ltrim($uri, "/"));
    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }
    return $paramsData;
}

function router ()
{
    $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    $routes = routes();

    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);

    $matchedUriExpressionMatch = regularExpressionMatchArrayRoutes($routes, $uri);

    $params = params($matchedUriExpressionMatch, $uri);

    $paramsData = formatParamsData($uri, $params);

    var_dump($paramsData);
    die();
}






