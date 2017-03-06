<?php

namespace comm\app\models;

use comm\app\core\Model;

class Comment extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * запись в бд поста
     * @param $data
     * @return bool
     */
    public function setPost($data)
    {
        try {
            $ins = $this->pdo->prepare('insert into posts (user_id,post,post_date) 
                                        VALUE (:user_id,:post,:post_date)');

            $ins->execute(array(
                ':user_id'   => $data['user_id'],
                ':post'      => $data['post'],
                ':post_date' => $data['post_date'],
            ));

            return true;
        } catch (\PDOException $e) {
            echo '<br></strong> Insert into table posts failed. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }

    /**
     * запись в бд комментария
     * @param $data
     * @return bool
     */
    public function setComment($data)
    {
        try {

            $ins = $this->pdo->prepare('insert into posts (user_id,parent_id,post,post_date) 
                                        VALUE (:user_id,:parent_id,:post,:post_date)');

            $ins->execute(array(
                ':user_id'   => $data['user_id'],
                ':parent_id' => $data['parent_id'],
                ':post'      => $data['post'],
                ':post_date' => $data['post_date'],
            ));

            return true;
        } catch (\PDOException $e) {
            echo '<br></strong> Insert into table posts failed. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }

    /**
     * получение из таблицы posts и users бд данных для вывода постов и комментариев
     * @return bool
     */
    public function getAll()
    {
        try {
            $sel = $this->pdo->prepare('select u.first_name,u.last_name, p.id,p.parent_id,p.post,p.post_date,p.user_id
                                 from posts p, users u
                                 where p.user_id=u.id
                                 order by p.post_date desc');

            $sel->execute();

            while ($row = $sel->fetch()) {
                $data[$row['id']] = $row;
            }

            return $data;
        } catch (\PDOException $e) {
            echo '<br></strong> Select from table posts failed. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }
}