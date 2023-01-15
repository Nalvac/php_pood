<?php
 function getPosts() {
     try
     {
         // On se connecte à MySQL
         $mysqlClient = new PDO(
             'mysql:host=localhost;
            dbname=blog;
            charset=utf8',
             'root',
             'root'
         );
     }
     catch(Exception $e)
     {
         // En cas d'erreur, on affiche un message et on arrête tout
         die('Erreur : '.$e->getMessage());
     }

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes
     $sqlQuery = 'SELECT * FROM posts';
     $recipesStatement = $mysqlClient->prepare($sqlQuery);
     $recipesStatement->execute();
     $recipesAns = $recipesStatement->fetchAll();

// On affiche chaque recette une à une
     $posts = [];
     foreach ($recipesAns as $recipe) {
         $post = [
             'title' => $recipe['title'],
             'french_creation_date' => $recipe['creation_date'],
             'content' => $recipe['content'],
             'identifier' => $recipe['id'],
         ];

         $posts[] = $post;
     }

     return $posts;
 }

 function getPostById($identifier) {
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

     $sqlQuery = "select id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date from posts where posts.id =?";
     $postStatement = $mysqlClient->prepare($sqlQuery);
     $postStatement->execute([$identifier]);
     $row = $postStatement->fetch();
     $post = [
              'title' => $row['title'],
             'french_creation_date' => $row['french_creation_date'],
             'content' => $row['content'],
             'identifier' => $row['id'],
         ];
     return $post;;
 }


