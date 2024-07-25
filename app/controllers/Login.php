<?php

namespace app\controllers;


class Login
{
    public function index(): array
    {
        return [
            'view' => 'login',
            'data' => ['title' => 'Login']
        ];
    }

    public function action()
    {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($email) || empty($password)) {
            return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');
        }

        // $user = findBy('users', 'email', $email);
        read('users', 'users.id, firstName, lastName, email, password, path');
        tableJoin('photos', 'id', 'left');
        where('email', '=', $email);

        $user = execute(isFetchAll: false);

        // dd($user);

        if (!$user) {
            return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');
        }

        // Validação sem usar hash

        // $password = trim($password);
        // $storedPassword = trim($user->password);

        // if($password != $storedPassword) {
        // return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');

        // }

        // Validação usando hash
        if (!password_verify($password, $user->password)) {
            return setMessageAndRedirect('message', 'Usúario ou senha estão incorretos', '/login');
        }

        unset($user->password);

        $_SESSION[LOGGED] = $user;

        return redirect();
    }


    public function destroy()
    {
        unset($_SESSION[LOGGED]);

        return [
            'view' => 'home',
            'data' => ['title' => 'Home']
        ];

        redirect();
    }
}