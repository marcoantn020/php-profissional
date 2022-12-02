<?php

function redirect($to)
{
    header("Location: {$to}");
    die();
}

function setMessageAndRedirect($index, $message, $redirectTo) {
    setFlash($index, $message);
    redirect($redirectTo);
}