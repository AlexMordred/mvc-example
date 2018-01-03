<?php

use Core\Router;

// Отлавливание исключений
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

try {
    // Создаем необходимые таблицы в БД, если они еще не созданы
    db()->install();

    // Загружаем маршруты
    require_once __DIR__ . '/../app/routes.php';

    // Определяем действие, соответствующее текущему маршруту
    $action = Router::resolveRoute($_SERVER['REQUEST_URI']);
    $controller = "App\\Controllers\\{$action['controller']}";
    $method = $action['method'];

    // Проверяем существуют ли указанные класс контроллера и метод в нем
    if (!class_exists($controller)) {
        abort(500, "Контроллер {$controller} не существует.");
    }

    if (!method_exists($controller, $method)) {
        abort(500, "Метод {$method} не существует в контроллере {$controller}.");
    }

    // Инициализация Twig
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../app/Views');
    $twig = new Twig_Environment($loader);

    // Выполняем метод из контроллера и выводим результат
    echo (new $controller($twig))->{$method}();
} catch (\Exception $e) {
    echo $e->xdebug_message;
}

// Завершаем скрипт
exit();
