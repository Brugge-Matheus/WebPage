<?php 

function dd($args) {
    return var_dump($args);
}

function redirect($page = '/') {
    return header("Location: {$page}");
}

function setMessageAndRedirect($index, $message, $redirectTo) {
    setFlash($index, $message);
    return redirect($redirectTo);
}