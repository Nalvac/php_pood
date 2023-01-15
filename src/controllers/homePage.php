<?php
    require_once('./src/models/model.php');
    function homePage() {
        $posts = getPosts();
        require('./template/homePage.php');
    }


