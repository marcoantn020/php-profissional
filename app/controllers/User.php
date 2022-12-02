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

    public function create()
    {
        return [
            "view" => "create.php",
            "data" => ["title" => "create"]
        ];
    }

    public function store()
    {
        $validate = validate(['lastName' => 'required',
            'firstName' => 'required',
            'username' => 'required|unique',
            'email' => 'required|email',
            'password' => 'required|maxlen']);

        if(!$validate) {
            redirect("/user/create");
        }

    }

}