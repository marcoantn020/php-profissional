<?php

namespace app\controllers;

class Login
{
    public function index()
    {
        return [
            "view" => "login.php",
            "data" => ["title" => "Login"]
        ];
    }

    public function store()
    {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

        if(empty($username) || empty($password)) {
            setMessageAndRedirect("message", "Preencha os campos.", "/login");
            return;
        }

        $user = findBy('users', 'username', $username);

        if(!$user) {
            setMessageAndRedirect("message", "Usuario e/ou senha inválidos.", "/login");
            return;
        }

        if(!password_verify($password, $user->password)) {
            setMessageAndRedirect("message", "Usuario e/ou senha inválidos.", "/login");
            return;
        }

        $_SESSION[LOGGED] = $user;
        redirect("/");
    }

    public function logout()
    {
        unset($_SESSION[LOGGED]);
        redirect("/login");
    }

}