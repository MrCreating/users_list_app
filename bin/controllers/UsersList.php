<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\User;

class UsersList extends Base
{
    public function __construct ()
    {
        $auth = Auth::check();
        if (!$auth) {
            return $this->redirect('/auth/');
        }
    }

    public function index (): static
    {
        return $this->show('users');
    }
}