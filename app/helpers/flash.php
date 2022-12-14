<?php

function setFlash($key, $message): void
{
    if(!$_SESSION["flash"][$key]) {
        $_SESSION["flash"][$key] = $message;
    }
}

function getFlash($key, $style = "color:red;display:block;padding:1px 2px;")
{
    if(isset($_SESSION["flash"][$key])) {
        $flash = $_SESSION["flash"][$key];
        unset($_SESSION["flash"][$key]);

        return "<span style='$style'> $flash </span>";
    }
    return "";
}