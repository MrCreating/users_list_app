<?php

namespace App\Controllers;

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
}