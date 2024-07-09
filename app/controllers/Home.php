<?php 
namespace app\controllers;

class Home {
    
    public function index($params) {
        $user = all('users');

        return [
            'view' => 'home',
            'data' => ['title' => 'Home', 'users' => $user]
        ];
    }

}