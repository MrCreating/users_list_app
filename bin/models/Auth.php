<?php

namespace App\Models;

class Auth extends Record
{
    private int $currentUserId;

    public function __construct(int $user_id = 0)
    {
        parent::__construct(true, 'user_id');

        $this->currentUserId = $user_id;
    }

    public function getUserId (): int
    {
        return $this->currentUserId;
    }

    public static function check (): ?Auth
    {
        $session = Session::create();

        return isset($session->user_id) ? new static($session->user_id) : NULL;
    }

    public static function start (string $login, string $password): ?Auth
    {
        $db = json_decode(file_get_contents(self::$dbPath), true);

        foreach ($db as $user) {
            if ($user['login'] === $login && $user['password'] === $password) {
                $session = Session::create();
                $session->user_id = $user['user_id'];

                return new static($user['user_id']);
            }
        }

        return NULL;
    }
}