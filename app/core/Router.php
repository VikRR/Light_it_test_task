<?php

namespace comm\app\core;

use comm\app\controllers\Errors;

/**
 *
 */
class Router
{
    private $error = true;
    private $routes;
    private $controller_namespace = 'comm\app\controllers\\';

    public function __construct()
    {
        $this->routes = require_once __DIR__ . '/../config/routes.php';
    }

    public function run()
    {
        $url = parse_url(ltrim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);

        foreach ($this->routes as $url_pattern => $path) {

            if (preg_match("~^$url_pattern$~", $url)) {
                $this->error = false;

                $internal_route = preg_replace("~$url_pattern~", $path, $url);

                $controller_action = explode('/', $internal_route);

                $controller = ucfirst(array_shift($controller_action));

                $this->controller_namespace .= $controller;

                $method = array_shift($controller_action);

                $controller_file = __DIR__ . '/controllers/' . $controller . '.php';

                //if (file_exists($controller_file)) {
                //    include_once $controller_file;
                //}

                $controller_obj = new $this->controller_namespace();

                $controller_obj->$method();
            }
        }

        if ($this->error) {
            $err = new Errors();

            $err->error404();
        }

        return true;
    }
}
