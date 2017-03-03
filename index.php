<?php

use comm\app\controllers\HomeController;
use comm\app\core\Router;

session_start();

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/app/config/database.php';
require __DIR__.'/app/config/auth.php';


$route = new Router();

$route->run();
