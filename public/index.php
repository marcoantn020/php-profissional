<?php

require "./bootstrap.php";

try {
    $data = router();

    if(!isset($data["data"])) {
        throw new \RuntimeException("O indice data esta faltando");
    }

    if(!isset($data["data"]["title"])) {
        throw new \RuntimeException("O indice title esta faltando");
    }


    if(!isset($data["view"])) {
        throw new \RuntimeException("O indice view esta falatando");
    }

    if(!file_exists(VIEWS.$data["view"])) {
        throw new \RuntimeException("Essa view {$data["view"]} não existe.");
    }

    extract($data["data"]);

    $view = $data["view"];

    require VIEWS . "master.php";

} catch (\RuntimeException $e) {
    var_dump($e->getMessage());
} catch (Exception $e) {
    var_dump($e->getMessage());
}