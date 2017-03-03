<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 28.02.17
 * Time: 14:47
 */

namespace comm\app\core;


class Controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

}