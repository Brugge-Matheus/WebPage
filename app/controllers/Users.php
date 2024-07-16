<?php

namespace app\controllers;

class Users
{

    public function index($params)
    {
        echo json_encode($_SERVER);
    }
}
