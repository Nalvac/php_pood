<?php

    require_once('./src/models/comment.php');
    function addComment (string $post, array $input) {
        $author= null;
        $comment = null;

        if(!empty($input['author'] && !empty($input['comment']))) {
            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            throw new Exception('Les données du formulaire ne sont pas valide');
        }
        $Success = createComment($post, $author, $comment);
        if(!isset($Success)) {
            throw new Exception('Impossible d\'ajouter un nouveau commentaire');
        } else {
            header('Location: index.php?action=post&id='.$post);
        }

    }