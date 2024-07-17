<?php

namespace app\controllers;

class Home
{

    public function index($params)
    {
        // $user = all('users');
        read('users');

        where('id', '=', '5');

        orWhere('name', '=', 'matheus');

        $user = execute();
        dd($user);

        // return [
        //     'view' => 'home',
        //     'data' => ['title' => 'Home', 'users' => $user]
        // ];
    }
}
