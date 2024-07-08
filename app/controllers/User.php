<?php 
namespace app\controllers;

class User {
    
    public function show($params) {

        if(!isset($params['user'])) {
            return redirect();
        }
        
        $user = findBy('users', 'id', $params['user']);
        dd($user);
        die();
    }

    public function create() {
        return [
            'view' => 'create.php',
            'data' => ['title' => 'Create']
        ];
    }

    
    public function action() {
        $validate = validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|maxlen:10'
        ]);

        if(!$validate) {
            return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);

        $created = create('users', $validate);

        if(!$created) {
            setFlash('message', 'Ocorreu um erro ao cadastrar');
            return redirect('/user/create');
        }

        setFlash('message', 'Usúario criado com sucesso');
        return redirect();
        
        
    }

}