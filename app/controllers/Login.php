<?php

namespace app\controllers;


class Login {
    public function index() {
        $_SESSION['logged'] = '';

        return [
            'view' => 'login.php',
            'data' => ['title' => 'Login']
        ];
    }

    public function action() {
        $_SESSION['logged'] = '';

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        
        if(empty($email) || empty($password)) {
            return redirect('/login');
        }

        $user = findBy('users', 'email', $email);

        if(!$user) {
            return redirect('/login');
        }
        
        // Verificação com hash
        // if(!password_verify($password, $user->password)) {
        //     return redirect('/login');
        // }

        if($password !== $user->password) {
            redirect('login');
        }

        $user = (array) $user;
        $_SESSION['logged'] = $user;
        return redirect();
    }
}