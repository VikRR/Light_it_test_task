<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 28.02.17
 * Time: 19:21
 */

namespace comm\app\core;


class View
{
    public function __construct()
    {
    }

    public function load($name, $data=null)
    {
        if (!empty($_SESSION['fb_id'])){
            require_once __DIR__ . '/../views/layouts/header.php';
            require_once __DIR__ . '/../views/comments/form.php';
            require_once __DIR__ . '/../views/' . $name . '.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        }else{
            require_once __DIR__ . '/../views/layouts/header.php';
            require_once __DIR__ . '/../views/' . $name . '.php';
            require_once __DIR__ . '/../views/layouts/footer.php';
        }
    }

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