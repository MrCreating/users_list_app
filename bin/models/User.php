<?php

namespace App\Models;


/**
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property int $age
 * @property string $login
 * @property string $password
 */
class User extends Record
{
    public function __construct(bool $isNew = true, string $primaryColumn = 'user_id')
    {
        parent::__construct($isNew, $primaryColumn);
    }

    public function toArray (): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'login' => $this->login,
            'password' => $this->password,
        ];
    }

    /**
     * @return array<User>
     */
    public static function getList(): array
    {
        $db = json_decode(file_get_contents(self::$dbPath), true);

        $result = [];

        foreach ($db as $user) {
           $user = User::find($user['user_id']);
           if ($user)
               $result[] = $user;
        }

        return $result;
    }
}