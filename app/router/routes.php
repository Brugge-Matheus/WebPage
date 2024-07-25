<?php

function routes(): array
{
    return [
        'POST' => [
            '/login' => 'Login@action',
            '/contact' => 'Contact@action',
            '/user/action' => 'User@action',
            '/user/[0-9]+' => 'User@update',
            '/user/password/[0-9]+' => 'Password@update',
            '/user/image/update' => 'UserImage@action'
        ],

        'GET' => [
            '/' => 'Home@index',
            '/user/create' => 'User@create',
            '/user/[0-9]+' => 'User@show',
            '/login' => 'Login@index',
            '/logout' => 'Login@destroy',
            '/contact' => 'Contact@index',
            '/editar/[0-9]+' => 'User@update',
            '/excluir/[0-9]+' => 'User@delete',
            '/user/edit/profile' => 'User@edit'
        ]
    ];
}