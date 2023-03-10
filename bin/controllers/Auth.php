<?php

namespace App\Controllers;

use App\Objects\Request;
use App\Objects\Response;
use JetBrains\PhpStorm\NoReturn;

class Auth extends Base
{
    public function __construct ()
    {
        $this->model = \App\Models\Auth::create();

        $auth = \App\Models\Auth::check();
        if ($auth) {
            $this->redirect('/users/');
        }
    }

    public function index (): static
    {
        return $this->show('auth');
    }

    #[NoReturn] public function start ()
    {
        $form = Request::create();

        $success = \App\Models\Auth::start($form->login, $form->password);
        $response = Response::create();

        if ($success) {
            $response->success = 1;
            $response->user_id = $success->getUserId();
        } else {
            $response->success = 0;
        }

        die($response);
    }
}