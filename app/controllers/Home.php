<?php

namespace app\controllers;

class Home
{

    public function index($params)
    {
        // $user = all('users');
        read('users');
        order('id', 'desc');

        paginate();






        $user = execute();
        dd($user);

        // return [
        //     'view' => 'home',
        //     'data' => ['title' => 'Home', 'users' => $user]
        // ];
    }
}