<?php

return [
    "POST" => [
        "/login" => "Login@store",
        "/user/store" => "User@store"
    ],
    "GET" => [
        "/" => "Home@index",
        "/login" => "Login@index",
        "/logout" => "Login@logout",
        "/user/create" => "User@create",
        "/user/[0-9]+" => "User@show"
    ]
];