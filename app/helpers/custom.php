<?php 

function dd(...$args) {
    foreach($args as $arg) {
        var_dump($arg);
    }
    die();
}

function redirect($page = '/') {
    return header("Location: {$page}");
}

function setMessageAndRedirect($index, $message, $redirectTo) {
    setFlash($index, $message);
    return redirect($redirectTo);
}