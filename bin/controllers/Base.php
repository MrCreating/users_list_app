<?php

namespace App\Controllers;

class Base extends \App\Objects\Base
{
    protected \App\Models\Base $model;

    private array $variables = [];

    public function context (array $variables = []): Base
    {
        // сделал так дабы переменные "скапливались" в контексте view, а не перезаписывались
        $this->variables = array_merge($this->variables, $variables);

        return $this;
    }

    /**
     * Рендер HTML и задача переменных в контекст
     * @param string $view - название view
     * @param array $variables - необязательный аргумент (переменные)
     */
    public function render (string $view, array $variables = []) {
        $this->context($variables);

        $path = __DIR__ . '/../views/' . $view . '.php';

        $result = '';
        if (file_exists($path)) {
            ob_start();
            extract($this->variables);
            require $path;
            $result = ob_get_clean();
        }

        return $result;
    }

    public function redirect (string $path = ''): Base
    {
        header('Location: /' . ltrim($path, '/'));
        return $this;
    }

    /**
     * Отображаем View пользователю
     */
    public function show (string $view, array $variables = []): Base
    {
        echo $this->render($view, $variables);
        return $this;
    }
}