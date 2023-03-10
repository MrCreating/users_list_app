<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../bin/Engine.php';

$app = \App\Engine::create();

$app->defaultRule(function () {
    return [
        '/' => \App\Controllers\Main::class
    ];
});

$app->run();