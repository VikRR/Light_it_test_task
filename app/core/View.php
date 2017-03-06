<?php

namespace comm\app\core;


class View
{
    public function __construct()
    {
    }

    /**
     * Подключаем шаблоны и разрешаем передачу данных в View
     * @param $name
     * @param null $data
     */
    public function load($name, $data = null)
    {
        if (!empty($_SESSION['fb_id'])) {
            require_once __DIR__ . '/../views/layouts/header.php';
            require_once __DIR__ . '/../views/comments/form.php';
            require_once __DIR__ . '/../views/' . $name . '.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        } else {
            require_once __DIR__ . '/../views/layouts/header.php';
            require_once __DIR__ . '/../views/' . $name . '.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        }
    }

    /**
     * Метод для обработки форм
     * @param $method (POST, GET...)
     * @return array
     */
    public function input($method)
    {
        $data = array();
        if ($method === 'post') {
            foreach ($_POST as $k => $v) {
                $data[$k] = $v;
            }
        } elseif ($method === 'get') {
            foreach ($_GET as $k => $v) {
                $data[$k] = $v;
            }
        }

        return $data;
    }
}