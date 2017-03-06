<?php

namespace comm\app\core;

class Router
{
    private $controller_namespace = 'comm\app\controllers\\';

    public function __construct()
    {
        $this->routes = require_once __DIR__ . '/../config/routes.php';
    }

    /**
     *  Router
     * @return bool
     */
    public function run()
    {
        $url = parse_url(ltrim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);

        foreach ($this->routes as $url_pattern => $path) {

            if (preg_match("~^$url_pattern$~", $url)) {

                $route = preg_replace("~$url_pattern~", $path, $url);

                $controller_action = explode('/', $route);

                $controller = ucfirst(array_shift($controller_action));

                $this->controller_namespace .= $controller;

                $method = array_shift($controller_action);

                $params = $controller_action;

                $controller_obj = new $this->controller_namespace();

                call_user_func_array(array($controller_obj, $method), $params);
            }
        }

        return true;
    }
}
