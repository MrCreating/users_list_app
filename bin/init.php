<?php

spl_autoload_register(function ($namespace) {
    $path = explode('\\', $namespace, 3);

    $path[1] = mb_strtolower($path[1]);

    array_splice($path, 0, 1);

    $path = __DIR__  . '/' . implode('/', $path) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});