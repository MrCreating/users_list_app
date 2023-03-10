<?php

require_once __DIR__ . '/../bin/Engine.php';

$app = \App\Engine::create()->withOutErrors();

$app->any(function () {
    return \App\Controllers\Main::create()->index();
})->defaultRule(function () {
    return [
        '/' => \App\Controllers\Main::class,
        '/users' => \App\Controllers\UsersList::class,
        '/auth' => \App\Controllers\Auth::class
    ];
});

$app->run();