<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 28.02.17
 * Time: 14:49
 */

namespace comm\app\controllers;


use comm\app\core\Controller;

class Comment extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->load('comments/index');
    }

    public function create()
    {
        //if (!isset($_POST['add_post'])) {
        //
        //    $this->view->load('comments/index');
        //
        //} else {
            $comment = $this->model->load('comment');

            $this->view->input('post');

            $data['fb_id'] = $_SESSION['fb_id'];

            $data['post_date'] = time();

            $comment->setComments($data);

            header('Location: comments');
        //}
        //
        //return true;
    }


    public function add()
    {
        echo 'comments controller@show';
    }
}