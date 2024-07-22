<?php

function redirect($page = '/')
{
    return header("Location: {$page}");
}

function setMessageAndRedirect($index, $message, $redirectTo)
{
    setFlash($index, $message);
    return redirect($redirectTo);
}

function arrayIsAssociative(array $data)
{
    return array_keys($data) !== range(0, count($data) - 1);
}

function actualUri()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);

    $uri = array(
        'id' => $uri[count($uri) - (count($uri) - 2)]
    );

    return $uri['id'];
}

function ddd($data)
{
    if ($_ENV['PRODUCTION'] === 'true') {
        dd('Something get wrong');
    }


    dd($data);
}