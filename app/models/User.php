<?php

namespace comm\app\models;

use comm\app\core\Model;

class User extends Model
{

    /**
     * Запись в бд зарегистрированного пользователя
     * @param $data
     * @return bool
     */
    public function setUser($data)
    {
        try {
            $ins = $this->pdo->prepare('insert into users(fb_id,first_name,last_name,email,reg_date) 
                                        values(:fb_id,:first_name,:last_name,:email,:reg_date)');
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

    /**
     * Проверяем по facebook id есть пользователь в нашей бд или нет
     * @param $data
     * @return bool|mixed
     */
    public function checkFbId($data)
    {
        try {
            $sel = $this->pdo->prepare('select count(fb_id) 
                                        from users 
                                        where fb_id=:fb_id');
            $sel->execute(array(':fb_id' => $data['fb_id']));
            $row = $sel->fetch();

            return $row;
        } catch (\PDOException $e) {
            echo '<br></strong> Не удалось проверить наличие fb_id в таблице Users. ' . $e->getMessage() . '</strong><br>';

            return false;
        }
    }

    /**
     * Получение данных пользователя из бд
     * @param $fb_id
     * @return bool|mixed
     */
    public function getUser($fb_id)
    {
        try {
            $sel = $this->pdo->prepare('select id 
                                        from users 
                                        where fb_id=:fb_id');
            $sel->execute(array('fb_id' => $fb_id));
            $data = $row = $sel->fetch();

            return $data;
        } catch (\PDOException $e) {
            echo '<br></strong> Не удалось получить данные из таблицы Users. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }

}