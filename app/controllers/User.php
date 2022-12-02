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
        $validate = validate([
            'firstName' => 'required|minlength:3',
            'lastName' => 'required',
            'username' => 'required|unique:users',
            'email' => 'email|unique:users',
            'password' => 'required|minlength:5'
        ]);

        if(!$validate) {
            redirect("/user/create");
        }

        $validate["password"] = password_hash($validate["password"], PASSWORD_DEFAULT);
        $created = create("users", $validate);

        if(!$created) {
            setMessageAndRedirect("message",
                "Erro ao cadastrar, tente novamente em alguns segundos.",
                "/user/create");
        }
        redirect("/");
    }

}