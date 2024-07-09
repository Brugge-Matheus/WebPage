<?php 

function routes(): array {
    return [
        'POST' => [
            '/login' => 'Login@action',
            '/user/action' => 'User@action'
        ],

        'GET' => [
            '/' => 'Home@index',
            '/user/create' => 'User@create',
            '/user/[0-9]+' => 'User@show',
            '/login' => 'Login@index',
            '/logout' => 'Login@destroy',
            '/editar/[0-9]+' => 'User@update'
        ]
    ];
}