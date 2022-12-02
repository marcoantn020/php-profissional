<?php

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle): bool
    {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

function validate(array  $validations)
{
    $result = [];
    $param = "";
    foreach ($validations as $field => $validate) {
        $result[$field] = (!str_contains($validate, "|")) ?
             singleValidation($validate, $param, $field) :
             multipleValidations($validate, $param, $field);
    }

    if(in_array(false, $result, true)) {
        return false;
    }

    return $result;
}

function singleValidation( $validate, $param, $field)
{
    if (str_contains($validate, ":")) {
        [$validate, $param] = explode(":", $validate);
    }
    return $validate($field, $param);
}


function multipleValidations( $validate, $param, $field)
{
    $result = null;
    $explodePipeValidate = explode("|", $validate);
    foreach ($explodePipeValidate as $validates) {
        if (str_contains($validates, ":")) {
            [$validates, $param] = explode(":", $validates);
        }
        $result = $validates($field, $param);
    }
    return $result;
}

function required($field)
{
    if($_POST[$field] === "") {
        setFlash($field, "O campo é obrigatorio.");
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}

function email($field)
{
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);
    if(!$emailIsValid) {
        setFlash($field, "O campo tem que ser um email valido.");
        return false;
    }
    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
}

function unique($field, $param)
{
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
    $user = findBy($param, $field, $data);

    if($user) {
        setFlash($field, "Este nome de usuario ja esta em uso.");
        return false;
    }

    return $data;
}

function minlength($field, $param)
{
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_STRING);
    $data = ltrim($data, " ");
    $data = rtrim($data, " ");
    if(strlen($data) < $param) {
        setFlash($field, "Este campo de ter no minimo {$param} caracteres.");
        return false;
    }
    return $data;
}