<?php 

function required($field) {
    if(empty($_POST[$field])) {
        setFlash($field, "O campo é obrigatório");
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_SPECIAL_CHARS);
}


function email($field) {
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    if(!$emailIsValid) {
        setFlash($field, 'O campo precisa ser um e-mail válido');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_SPECIAL_CHARS);
}


function unique($field, $param) {
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_SPECIAL_CHARS);

    $user = findBy($param, $field, $data);

    if($user) {
        setFlash($field, "Este {$field} ja esta cadastrado");
        return false;
    }

    return $data;
}


function maxlen($field, $param) {
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_SPECIAL_CHARS);

    if(strlen($data) > $param) {
        setFlash($field, "Esse campo não pode passar de {$param} caracteres");

        return false;
    }

    return $data;
}