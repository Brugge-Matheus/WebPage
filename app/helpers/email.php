<?php

use PHPMailer\PHPMailer\PHPMailer;

function config()
{
    $mail = new PHPMailer();

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];

    return $mail;
}

function send(stdClass|array $data)
{
    $body = (isset($data->template)) ? template($data) : $data->message;

    checkPropertiesEmail($data);

    try {
        $mail = config();

        $mail->setFrom($data->fromEmail, $data->fromName);
        $mail->addAddress($data->toEmail, $data->toName);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data->subject;
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $mail->send();
    } catch (Exception $e) {
        dd($e);
    }
}

function checkPropertiesEmail($data)
{
    $propertiesRequired = ['fromName', 'fromEmail', 'toName', 'toEmail', 'subject', 'message'];
    unset($data->template);

    $emailVars = get_object_vars($data);

    foreach ($propertiesRequired as $propertie) {
        if (!in_array($propertie, array_keys($emailVars))) {
            throw new Exception("A proprieadade '{$propertie}' esta faltando", 360);
        }
    }
}

function template($data)
{

    $templateFile = BASE_DIR . "/app/views/emails/{$data->template}.html";

    if (!file_exists($templateFile)) {
        throw new Exception("O template {$data->template}.html não existe", 361);
    }

    $template =
        file_get_contents($templateFile);

    $emailVars = get_object_vars($data);

    // Forma alterantiva
    // $vars = [];

    // foreach ($emailVars as $key => $value) {
    //     $vars["@{$key}"] = $value;
    // }

    // Utilizando array_map
    $arr = array_map(function ($key) {
        return "@{$key}";
    }, array_keys($emailVars));

    return str_replace($arr, array_values($emailVars), $template);
}