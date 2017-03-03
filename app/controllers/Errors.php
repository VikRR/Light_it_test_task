<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 28.02.17
 * Time: 15:18
 */

namespace comm\app\controllers;


use comm\app\core\Controller;

class Errors extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error404()
    {
        echo 'Page not found.';
    }
}