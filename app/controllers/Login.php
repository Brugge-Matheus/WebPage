<?php

namespace app\controllers;

class Login {
    public function index() {
        return [
            'view' => 'login.php',
            'data' => ['title' => 'Login']
        ];
    }

    public function action() {
        dd($_POST);
        die();
    }
}