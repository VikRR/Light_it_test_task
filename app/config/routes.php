<?php

return array(
    ''              => 'home/index',
    'callback'      => 'home/fbCallback',
    'post/([0-9]+)' => 'comment/createComment/$1',
    'post'          => 'comment/createPost',
    'comments'      => 'comment/index',
    'logout'        => 'home/logout',

);