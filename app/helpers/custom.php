<?php 

function dd($args) {
    return var_dump($args);
}

function redirect($page = '/') {
    return header("Location: {$page}");
}