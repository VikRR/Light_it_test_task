<?php

namespace comm\app\core;


class Controller
{
    public $model;
    public $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

}