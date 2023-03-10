<?php

namespace App\Objects;

use App\Exceptions\WrongSetOperation;

class Request extends Base
{
    protected array $data = [];

    public function __construct ()
    {
        parse_str(explode("?", $_SERVER["REQUEST_URI"])[1], $_REQUEST);
        $this->data = array_merge($_REQUEST, array_merge($_GET, $_POST));
    }

    public function __get (string $key): ?string
    {
        return $this->data[$key];
    }

    /**
     * @throws WrongSetOperation
     */
    public function __set (string $key, mixed $value): void
    {
        throw new WrongSetOperation('Unable to set field to Request');
    }
}