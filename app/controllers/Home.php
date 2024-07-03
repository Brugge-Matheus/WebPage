<?php 
namespace app\controllers;

class Home {
    
    public function index($params) {
        $user = all('users');

        return [
            'view' => 'home.php',
            'data' => ['title' => 'Home', 'users' => $user]
        ];
    }

}