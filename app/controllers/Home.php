<?php

namespace app\controllers;

class Home
{

    public function index($params)
    {
        // $users = all('users');

        $search = filter_input(INPUT_GET, 's', FILTER_SANITIZE_SPECIAL_CHARS);

        read('posts', 'title, slug, content, firstName, lastName, email');
        tableJoinWithFK('users', 'id');

        paginate(5);


        $users = execute();

        return [
            'view' => 'home',
            'data' => ['title' => 'Home', 'users' => $users, 'links' => render()]
        ];
    }
}