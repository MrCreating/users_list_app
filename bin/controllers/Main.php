<?php

namespace App\Controllers;

use App\Models\Session;

class Main extends Base
{
    public function __construct ()
    {
        $this->model = \App\Models\Main::create();
    }

    public function index (): string
    {
        return $this->context(['text' => 'Hello World!'])->show('main');
    }
}