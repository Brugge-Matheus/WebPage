<?php

function routes(): array
{
    return [
        'POST' => [
            '/login' => 'Login@action',
            '/contact' => 'Contact@action',
            '/user/action' => 'User@action'
        ],

        'GET' => [
            '/' => 'Home@index',
            '/user/create' => 'User@create',
            '/user/[0-9]+' => 'User@show',
            '/login' => 'Login@index',
            '/contact' => 'Contact@index',
            '/logout' => 'Login@destroy',
            '/editar/[0-9]+' => 'User@update',
            '/excluir/[0-9]+' => 'User@delete'
        ]
    ];
}