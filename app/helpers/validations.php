<?php

function required($field)
{
    if (empty($_POST[$field])) {
        setFlash($field, "O campo é obrigatório");
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}


function optional($field)
{
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($data === '') {

        return null;
    }

    return $data;
}


function email($field)
{
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    if (!$emailIsValid) {
        setFlash($field, 'O campo precisa ser um e-mail válido');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function uniqueUpdate($field, $param)
{
    $email = filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!str_contains($param, '=')) {
        throw new Exception("Na validação uniqueValidate é necessário ter o sinal de =", 370);
        return false;
    }

    [$fieldToCompare, $value] = explode('=', $param);

    if (!str_contains($fieldToCompare, ',')) {
        throw new Exception("Na validação uniqueValidate é necessário ter a virgula", 370);
        return false;
    }

    $table =  substr($fieldToCompare, 0, strpos($fieldToCompare, ','));
    $fieldToCompare = substr($fieldToCompare, strpos($fieldToCompare, ',') + 1);

    read($table);
    where($field, $email);
    orWhere($fieldToCompare, '!=', $value, 'and');
    $userFound = execute(isFetchAll: false);

    if ($userFound) {
        setFlash($field, "Este {$field} ja esta cadastrado");
        return false;
    }


    return $email;
}

function unique($field, $param)
{
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = findBy($param, $field, $data);

    if ($user) {
        setFlash($field, "Este {$field} ja esta cadastrado");
        return false;
    }

    return $data;
}


function maxlen($field, $param)
{
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (strlen($data) > $param) {
        setFlash($field, "Esse campo não pode passar de {$param} caracteres");

        return false;
    }

    return $data;
}

function confirmed($field)
{

    if (!isset($_POST[$field], $_POST['confirm_' . $field])) {
        setFlash($field, "Ambos os campos precisam estar preenchidos");

        return false;
    }

    $value = filter_input(INPUT_POST, $field);
    $value_confirmation = filter_input(INPUT_POST, 'confirm_password');

    if (trim($value) !== trim($value_confirmation)) {
        setFlash('different_' . $field, "Ambos os campos precisam ser iguais");
        return false;
    }

    if ($field === 'password') {
        return password_hash($value, PASSWORD_DEFAULT);
    }


    return $value;
}
