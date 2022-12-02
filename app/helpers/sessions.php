<?php

function user() {
    return $_SESSION[LOGGED] ?? null;
}

function logged(): bool
{
    return isset($_SESSION[LOGGED]);
}
