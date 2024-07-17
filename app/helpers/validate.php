<?php

function validate(array $validations, bool $persistInput = false, bool $checklCsrf = false)
{
    if ($checklCsrf) {

        try {
            checkCsrf();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    $result = [];
    $param = '';

    foreach ($validations as $field => $validate) {

        if (!str_contains($validate, '|')) {
            $result[$field] = singleValidation($validate, $field, $param);
        } else {
            $result[$field] = multipleValidations($validate, $field, $param);
        }
    }

    if ($persistInput) {
        setOld();
    }

    if (in_array(false, $result)) {
        return false;
    }

    return $result;
}


function singleValidation($validate, $field, $param)
{
    if (str_contains($validate, ':')) {
        [$validate, $param] = explode(':', $validate);
    }

    return $result[$field] = $validate($field, $param);
}


function multipleValidations($validate, $field, $param)
{
    $explodePipeValidate = explode('|', $validate);
    $result = [];

    foreach ($explodePipeValidate as $validate) {

        if (str_contains($validate, ':')) {
            [$validate, $param] = explode(':', $validate);
        }

        $result[$field] = $validate($field, $param);

        if (isset($result[$field]) && $result[$field] === false) {
            break;
        }
    }

    return $result[$field];
}