<?php

namespace App\Objects;

/**
 * Базовый объект для всего
 */
class Base
{
    public function __toString (): string
    {
        $class = new \ReflectionObject($this);

        return $class->getName();
    }

    public function __serialize(): array
    {
        return [];
    }

    public function __unserialize(array $data): void
    {
        // ok...
    }

    public function __isset (string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function create (): static
    {
        return new static();
    }
}