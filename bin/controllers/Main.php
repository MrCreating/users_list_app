<?php

namespace App\Controllers;

use App\Models\Auth;

class Main extends Base
{
    public function __construct ()
    {
        $this->model = \App\Models\Main::create();

        $auth = Auth::check();
        if ($auth) {
            $this->redirect('/users/');
        } else {
            $this->redirect('/auth/');
        }
    }

    public function index (): static
    {
        return $this;
    }
}