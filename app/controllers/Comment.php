<?php

namespace comm\app\controllers;


use comm\app\core\Controller;

class Comment extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function index()
    {
        $model = $this->model->load('comment');

        $tree = $this->setCommentTree($model->getAll());

        $data = $this->showPosts($tree);

        $this->view->load('comments/index', $data);

        return true;
    }

    /**
     *Создание поста
     */
    public function createPost()
    {
        $comment = $this->model->load('comment');

        $post = $this->view->input('post');

        $data['post'] = $post['post'];

        $data['user_id'] = $_SESSION['user_id'];

        $data['post_date'] = time();

        $comment->setPost($data);

        header('Location: comments');
    }

    /**
     * Создание комментариев
     * @param $id
     */
    public function createComment($id)
    {
        $comment = $this->model->load('comment');

        $post = $this->view->input('post');

        $data['post'] = $post['comment'];

        $data['user_id'] = $_SESSION['user_id'];

        $data['post_date'] = time();

        $data['parent_id'] = $id;

        $comment->setComment($data);

        header('Location: /');
    }


    /**
     * Обработка массива с данными из бд, форматирование массива т.о. что ключи массива являються id родительского поста
     * @param $data
     * @return array
     */
    public function setCommentTree($data)
    {
        $comment_tree = array();
        foreach ($data as $array) {
            if (empty($comment_tree[$array['parent_id']])) {
                $comment_tree[$array['parent_id']] = array();
            }
            $comment_tree[$array['parent_id']][] = $array;
        }

        return $comment_tree;
    }

    /**
     * Обработка подготовленного массива рекурсивной функцией с выводом информации в виде строки
     * @param $data
     * @param int $parent_id
     * @return string
     */
    public function showPosts($data, $parent_id = 0)
    {
        $posts = '';
        if (empty($data[$parent_id])) {

            return $posts;
        }

        $posts .= '<ul class="list-group">';

        for ($i = 0; $i < count($data[$parent_id]); $i++) {

            $posts .= '<li class="list-group-item"><div><p>' . date('Y-m-d H:i:s',
                    $data[$parent_id][$i]['post_date']) . '</p>';

            $posts .= '<p>' . $data[$parent_id][$i]['first_name'] . '&nbsp;' . $data[$parent_id][$i]['last_name'] . '</p>';

            $posts .= '<p>' . $data[$parent_id][$i]['post'] . '</p></div>';

            $posts .= $this->showPosts($data, $data[$parent_id][$i]['id']);

            $posts .= '<button class="add-comment" data-toggle="modal" data-target="#myModal" data-post-id="' . $data[$parent_id][$i]['id'] .'">Добавить комментарий</button>';

            $posts .= '</li>';

        }
        $posts .= '</ul>';


        return $posts;
    }

}