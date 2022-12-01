<?php

function connect()
{
    return new PDO("mysql:host=mysql-my-app;dbname=myapp", "root", "root", [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
}