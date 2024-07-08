<?php 

function validate(array $validations) {
    $result = [];
    $param = '';
    
    foreach($validations as $field => $validate) {

        if(!str_contains($validate, '|')) {
            $result[$field] = singleValidation($validate, $field, $param);

        } else {
            $result[$field] = multipleValidations($validate, $field, $param);
        }
    }
        
    if(in_array(false, $result)) {
        return false;
    }

    return $result;
}


function singleValidation($validate, $field, $param) {
    if(str_contains($validate, ':')) {
        [$validate, $param] = explode(':', $validate);
    }

    return $result[$field] = $validate($field, $param);
}


function multipleValidations($validate, $field, $param) {
    $explodePipeValidate = explode('|', $validate);

    foreach($explodePipeValidate as $validate) {

        if(str_contains($validate, ':')) {
            [$validate, $param] = explode(':', $validate);
        }
                
        $result = $validate($field, $param);
    }

    return $result;
}


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