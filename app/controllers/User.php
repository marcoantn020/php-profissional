<?php

namespace app\controllers;

class User
{
    public function show($params)
    {
        if(!isset($params["user"])) {
            redirect("/");
        }

        $user = findBy("users", "id", $params["user"]);
        var_dump($user);
        die();
    }

}