<?php

namespace App\Models;

class User extends Record
{
    public function __construct(bool $isNew = true, string $primaryColumn = 'user_id')
    {
        parent::__construct($isNew, $primaryColumn);
    }
}