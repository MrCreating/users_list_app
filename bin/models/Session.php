<?php

namespace App\Models;

class Session extends Base
{
    public function __construct ()
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    public function __get (string $key): ?string
    {
        return $_SESSION[$key];
    }

    public function __set (string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function __destruct ()
    {
        session_write_close();
    }
}