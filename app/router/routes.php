<?php

function routes(): array {
    return [
        '/' => 'Home@index',
        '/user/create' => 'User@create'
    ];
}