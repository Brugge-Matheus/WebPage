<?php 

function routes(): array {
    return [
        'POST' => [
            '/login' => 'Login@action'
        ],

        'GET' => [
            '/' => 'Home@index',
            '/user/create' => 'User@create',
            '/user/[0-9]+' => 'User@show',
            '/login' => 'Login@index',
            '/logout' => 'Login@destroy'
        ]
    ];
}