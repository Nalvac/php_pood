<?php

    function connectToDb() {
        try {
            $mysqlClient = new PDO(
                'mysql:host=localhost;
             dbname=blog;
             charset=utf8',
                'root',
                'root'
            );
        }catch (Exception $e){
            die('Erreur: ' .$e->getMessage());
        }
        return $mysqlClient;
    }

function getComments($identifier): array
{
    $mysqlClient  = connectToDb();
    $sqlQuery = "
            select c.author, c.comment, DATE_FORMAT(c.comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date
            From comments c 
            where c.post_id=? 
            order by c.comment_date desc 

    ";
    $commentStatement = $mysqlClient->prepare($sqlQuery);
    $commentStatement->execute([$identifier]);
    $comments = [];
    while (($row = $commentStatement->fetch())) {
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['comment_date'],
            'comment' => $row['comment'],
        ];
        $comments[] = $comment;
    }
    return $comments;

}
    function createComment($post, $author, $comment): bool {
        $database  = connectToDb();
        $statement = $database->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines  > 0);
    }