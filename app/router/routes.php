<?php

function routes(): array
{
    return [
        'POST' => [
            '/login' => 'Login@action',
            '/user/action' => 'User@action'
        ],

        'GET' => [
            '/' => 'Home@index',
            '/users' => 'Users@index',
            '/user/create' => 'User@create',
            '/user/[0-9]+' => 'User@show',
            '/login' => 'Login@index',
            '/logout' => 'Login@destroy',
            '/editar/[0-9]+' => 'User@update',
            '/excluir/[0-9]+' => 'User@delete'
        ]
    ];
}
