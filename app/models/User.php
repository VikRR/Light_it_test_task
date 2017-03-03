<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 01.03.17
 * Time: 19:25
 */

namespace comm\app\models;


use comm\app\core\DB;
use comm\app\core\Model;

class User extends Model
{

    public function setUser($data)
    {
        $pdo = DB::connect();
        try {
            $ins = $pdo->prepare('insert into users(fb_id,first_name,last_name,email,reg_date) values(:fb_id,:first_name,:last_name,:email,:reg_date)');
            $ins->execute(array(
                ':fb_id'      => $data['fb_id'],
                ':first_name' => $data['first_name'],
                ':last_name'  => $data['last_name'],
                ':email'      => $data['email'],
                ':reg_date'   => $data['reg_date'],
            ));

            return true;
        } catch (\PDOException $e) {
            echo '<br></strong> Не удалось добавить новую запись в таблицу Users. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }

    public function checkFbId($data)
    {
        $pdo = DB::connect();
        try {
            $sel = $pdo->prepare('select count(fb_id) from users where fb_id=:fb_id');
            $sel->execute(array(':fb_id' => $data['fb_id']));
            $row = $sel->fetch();

            return $row;
        } catch (\PDOException $e) {
            echo '<br></strong> Не удалось проверить наличие fb_id в таблице Users. ' . $e->getMessage() . '</strong><br>';

            return false;
        }
    }

    public function getUser()
    {
        $pdo = DB::connect();
        $data = array();
        try {
            $sel = $pdo->prepare('select * from users');
            $sel->execute();
            while ($row = $sel->fetch()) {
                $data[] = $row;
            }

            return $data;
        } catch (\PDOException $e) {
            echo '<br></strong> Не удалось получить данные из таблицы Users. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }

}