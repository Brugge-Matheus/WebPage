<?php

namespace app\controllers;

use stdClass;

class Contact
{
    public function index()
    {
        return [
            'view' => 'contact',
            'data' => ['title' => 'Contact']
        ];
    }

    public function action()
    {
        $validated = validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ], persistInput: true, checklCsrf: true);

        if (!$validated) {
            return redirect('/contact');
        }

        $email = new stdClass;

        $email->fromName = $validated['name'];
        $email->fromEmail = $validated['email'];
        $email->toName = $_ENV['TONAME'];
        $email->toEmail = $_ENV['TOEMAIL'];
        $email->subject = $validated['subject'];
        $email->message = $validated['message'];

        $email->template = 'contact';

        $sent = send($email);

        if ($sent) {
            return setMessageAndRedirect('contact_sucess', 'E-mail enviado com sucesso', '/contact');
        }

        setMessageAndRedirect('contact_error', 'Ocorreu um problema ao enviar o e-mail', '/contact');
    }
}