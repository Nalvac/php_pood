<?php
    require_once('./src/models/model.php');
    require_once ('./src/models/comment.php');

    function post($identifier) {
        $post = getPostById($identifier);
        $comments = getComments($identifier);
        require('template/post.php');
    }