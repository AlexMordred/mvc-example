<?php

namespace Core;

class Response
{
    /**
     * Устанавливает HTTP код. Возвращает данные в формате JSON, если таковые присутствуют
     *
     * @param array $data данные дла конвертации в JSON
     * @param integer $status HTTP код статуса для ответа
     * @return string пустая строка, или строка с закодированным JSON
     */
    public function response($data = null, $status = 200)
    {
        http_response_code($status);

        if (isset($data)) {
            return json_encode(array_merge([
                'status' => $status
            ], $data));
        } else {
            return '';
        }
    }

    /**
     * Возвзращает пустой ответ со статусом 200
     *
     * @return string пустая строка
     */
    public function ok()
    {
        return $this->response(null);
    }

    /**
     * Возвзращает пустой ответ с указанным статусом
     *
     * @return string пустая строка
     */
    public function status($status)
    {
        return $this->response(null, $status);
    }

    /**
     * Возвращает JSON ответ с массивом ошибок
     *
     * @param array $errors массив ошибок
     * @param integer HTTP код статуса для ответа
     * @return string строка с закодированным JSON
     */
    public function errors($errors, $status = 422)
    {
        return $this->response(['errors' => $errors], $status);
    }
}
