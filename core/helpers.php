<?php

use Core\DB;
use Core\Response;

/**
 * Возвращает сообщение об ошибке c указанным HTTP кодом статуса, после чего
 * прекращает выполнение скрипта
 *
 * @param integer $status HTPP код статуса
 * @param string $message сообщение с ошибкой
 * @return void
 */
function abort($status, $message)
{
    http_response_code($status);

    echo $message;

    exit();
}

/**
 * Инициализирует и возвращает объект Core\DB
 *
 * @return Core\DB
 */
function db()
{
    return DB::init();
}

/**
 * Инициализирует и возвращает объект Core\Response
 *
 * @return Core\Response
 */
function response()
{
    return new Response();
}
