<?php

namespace App\Objects;

use App\Exceptions\WrongSetOperation;

class Response extends Base
{
    protected array $data = [];

    public function __construct ()
    {
    }

    public function build (): array
    {
        return $this->data;
    }

    public function __toString(): string
    {
        return json_encode($this->build(), JSON_PRETTY_PRINT);
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
        $this->data[$key] = $value;
    }
}