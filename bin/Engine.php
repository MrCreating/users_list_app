<?php

namespace App;

require_once __DIR__ . '/init.php';

use App\Controllers\Auth;
use App\Exceptions\RouteNotFoundException;

/**
 * Базовый класс, входная точка в наше приложение
 */
class Engine
{
    protected array $routes = [
        'routes' => [],
        'rules' => [],
        'default' => null
    ];

    public function __construct () {}

    /**
     * Обрабатываем маршрут
     */
    public function route (string $route, callable $callback): Engine
    {
        $this->routes['routes'][$route] = $callback;

        return $this;
    }

    /**
     * Обработчик для любых ссылок.
     * Можно использовать как обработчик всего, кроме ...
     */
    public function any (callable $callback): Engine
    {
        $this->routes['default'] = $callback;

        return $this;
    }

    /**
     * Запускаем приложение
     * @throws RouteNotFoundException
     */
    public function run (): void
    {
        $url = strtolower(explode('?', $_SERVER['REQUEST_URI'])[0]);

        // просто перебираем все пути, не суть
        foreach ($this->routes['routes'] as $route => $callback)
        {
            if ($route == $url && is_callable($callback)) {
                call_user_func($callback);
                return;
            }
        }

        $action_data = explode('/', $url);

        $action = array_splice($action_data, count($action_data) - 1, 1)[0];
        $rule = implode('/', $action_data);

        if ($action === '') $action = 'index';
        if ($rule === '') $rule = '/';

        foreach ($this->routes['rules'] as $route => $controller) {
            if ($rule === $route) {
                if (method_exists($controller, $action)) {
                    call_user_func([new $controller, $action]);
                    return;
                }
            }
        }

        if (isset($this->routes['default']) && is_callable($this->routes['default'])) {
            call_user_func($this->routes['default']);
            return;
        }
    }

    /**
     * @throws RouteNotFoundException
     */
    public function defaultRule (callable $callback): void
    {
        $result = call_user_func($callback);

        if (!is_array($result))
            throw new RouteNotFoundException('Rules list must be array');

        $this->routes['rules'] = $result;
    }

    public function withOutErrors (): static
    {
        ini_set('display_errors', 0);
        error_reporting(0);
        return $this;
    }

    /**
     * Инициируем приложение
     */
    public static function create (): Engine
    {
        static $lastApp;

        if (!isset($lastApp))
            $lastApp = new static();

        return $lastApp;
    }
}