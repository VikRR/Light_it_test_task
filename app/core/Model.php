<?php


namespace comm\app\core;


class Model
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function load($name)
    {
        $model = 'comm\app\models\\';
        $model .= ucfirst($name);

        return new $model();
    }

}