<?php

namespace app\controllers;

class User
{

    public function show($params)
    {

        if (!isset($params['user'])) {
            return redirect();
        }

        // $user = findBy('users', 'id', $params['user']);
    }

    public function create()
    {
        return [
            'view' => 'create',
            'data' => ['title' => 'Create']
        ];
    }

    public function edit()
    {
        if (!logged()) {
            redirect();
        }

        read('users', 'users.id, firstName, lastName, email, password, path');
        tableJoin('photos', 'id', 'left');
        where('users.id', '=', user()->id);

        $user = execute(isFetchAll: false);

        return [
            'view' => 'edit',
            'data' => ['title' => 'Edit', 'user' => $user]
        ];
    }

    public function action()
    {
        $validate = validate([
            'firstName' => 'required',
            'lastName' => 'optional',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ], persistInput: true, checklCsrf: true);

        if (!$validate) {
            return redirect('/user/create');
        }

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);

        $created = create('users', $validate);

        if (!$created) {
            setFlash('message', 'Ocorreu um erro ao cadastrar');
            return redirect('/user/create');
        }

        setFlash('message', 'Usúario criado com sucesso');
        return redirect();
    }

    public function update($args)
    {
        if (!isset($args['user']) || $args['user'] != user()->id) {
            return redirect();
        }

        $validated = validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|uniqueUpdate:users,id=' . user()->id
        ]);

        if (!$validated) {
            return redirect('/user/edit/profile');
        }

        $updated = update('users', $validated, ['id' => user()->id]);

        if ($updated) {
            return setMessageAndRedirect('updated_success', 'Dados atualizados com sucesso', '/user/edit/profile');
        }

        setMessageAndRedirect('updated_error', 'Ocorreu um erro ao atualizar seus dados', '/user/edit/profile');
    }

    public function delete()
    {
        return dd(delete('users', ['id' => actualUri()]));
    }
}
