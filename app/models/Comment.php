<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 01.03.17
 * Time: 16:52
 */

namespace comm\app\models;


use comm\app\core\DB;
use comm\app\core\Model;

class Comment extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setComments($data)
    {
        $pdo = DB::connect();
        try {
            $ins = $pdo->prepare('insert into posts (fb_id,post,post_date) VALUE (:fb_id,:post,:post_date)');

            $ins->execute(array(
                ':fb_id'     => $data['fb_id'],
                ':post'      => $data['post'],
                ':post_date' => $data['post_date']
            ));

            return true;
        } catch (\PDOException $e) {
            echo '<br></strong> Insert failed. ' . $e->getMessage() . '</strong>';

            return false;
        }
    }
}