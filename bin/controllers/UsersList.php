<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Session;
use App\Models\User;
use App\Objects\Request;
use App\Objects\Response;
use JetBrains\PhpStorm\NoReturn;

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
        return $this->context([
            'users' => User::getList(),
            'user' => User::find(Session::create()->user_id)
        ])->show('users');
    }

    public function new (): static
    {
        return $this->show('create_user');
    }

    #[NoReturn] public function create_new (): string
    {
        $form = Request::create();
        $response = Response::create();

        $user = new User();
        $user->first_name = $form->first_name;
        $user->last_name = $form->last_name;
        $user->age = $form->age;
        $user->login = $form->login;
        $user->password = $form->password;
        $user->save();

        $response->success = 1;
        die($response);
    }

    public function find_user (): string
    {
        $form = Request::create();
        $response = Response::create();

        $user = User::find($form->user_id);
        if (!$user) {
            $response->success = 0;
        } else {
            $response->success = 1;
            $response->user = $user->toArray();
        }

        die($response);
    }

    #[NoReturn] public function update (): string
    {
        $form = Request::create();
        $response = Response::create();

        $user = User::find($form->user_id);
        if (!$user) {
            $response->success = 0;
        } else {
            $user->first_name = $form->first_name;
            $user->last_name = $form->last_name;
            $user->age = $form->age;
            $user->login = $form->login;
            $user->password = $form->password;
            $user->save();

            $response->success = 1;
        }
        die($response);
    }

    public function remove (): string
    {
        $form = Request::create();
        $response = Response::create();

        $user = User::find($form->user_id);
        if (!$user) {
            $response->success = 0;
        } else {
            $user->delete();
            $response->success = 1;
        }

        die($response);
    }

    public function logout (): static
    {
        unset(Session::create()->user_id);
        return $this->redirect('/auth/');
    }
}