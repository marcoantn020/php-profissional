<?php

require "./bootstrap.php";

try {
    router();
} catch (\RuntimeException $e) {
    var_dump($e->getMessage());
} catch (Exception $e) {
    var_dump($e->getMessage());
}