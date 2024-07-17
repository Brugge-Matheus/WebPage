<?php

function getCsrf()
{
    $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(8));

    return "<input name='csrf' type='hidden' value='" . $_SESSION['csrf'] . "'>";
}

function checkCsrf()
{
    $csrf = filter_input(INPUT_POST, 'csrf', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($csrf)) {
        throw new Exception("Token inválido", 110);
    }

    if (!isset($_SESSION['csrf'])) {
        throw new Exception("Token inválido", 111);
    }

    if ($csrf !== $_SESSION['csrf']) {
        throw new Exception("Token inválido", 112);
    }

    unset($_SESSION['csrf']);

    return true;
}