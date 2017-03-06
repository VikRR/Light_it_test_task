<?php

use comm\app\core\Router;

session_start();

define('ROOT',__DIR__);

require ROOT.'/vendor/autoload.php';
require ROOT.'/app/config/database.php';
require ROOT.'/app/config/auth.php';


$route = new Router();

$route->run();
