<?php

namespace app\controllers;

use stdClass;

class Password
{
    public function update($args)
    {
        $user = user();
        if (!isset($args['password']) || $args['password'] != $user->id) {
            return redirect();
        }

        $validated = validate([
            'password' => 'required|confirmed',
            'confirm_password' => 'required'
        ], checklCsrf: true);

        if (!$validated) {
            return redirect('/user/edit/profile');
        }

        $updated = update('users', ['password' => $validated['password']], ['id' => $user->id]);

        if ($updated) {

            $email = new stdClass;

            $email->fromName = $_ENV['FROMNAME'];
            $email->fromEmail = $_ENV['FROMEMAIL'];
            $email->toName = $user->firstName;
            $email->toEmail = $user->email;
            $email->subject = 'Alteração de senha';
            $email->message = 'Senha alterada com sucesso!';

            $email->template = 'password';

            send($email);

            return setMessageAndRedirect('success_updated_password', "Senha alterada com sucesso", '/user/edit/profile');
        }

        setMessageAndRedirect('error_updated_password', "Ocorreu um erro ao atualizar sua senha", '/user/edit/profile');
    }
}
