<?php

require "./bootstrap.php";

try {
    $data = router();

    extract($data["data"]);

    if(!isset($data["view"])) {
        throw new \RuntimeException("O indice view esta falatando");
    }

    if(!file_exists(VIEWS.$data["view"])) {
        throw new \RuntimeException("Essa view {$data["view"]} não existe.");
    }

    $view = $data["view"];

    require VIEWS . "master.php";

} catch (\RuntimeException $e) {
    var_dump($e->getMessage());
} catch (Exception $e) {
    var_dump($e->getMessage());
}