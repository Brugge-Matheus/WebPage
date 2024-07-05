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
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($email) || empty($password)) {
        return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');
    }

    $user = findBy('users', 'email', $email);

    if(!$user) {
        return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');
    }

    $password = trim($password);
    $storedPassword = trim($user->password);

    if($password != $storedPassword) {
    return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');
        
    }

    $_SESSION[LOGGED] = $user;
    return redirect();
}


    public function destroy() {
        unset($_SESSION[LOGGED]);

        return redirect();
    }

}