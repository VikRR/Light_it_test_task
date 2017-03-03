<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 01.03.17
 * Time: 16:46
 */

namespace comm\app\core;


class Model
{
    public $pdo;

    public function __construct()
    {
        //$this->pdo = DB::connect();
    }

    public function load($name)
    {
        $model = 'comm\app\models\\';
        $model .= ucfirst($name);

        return new $model();
    }

}