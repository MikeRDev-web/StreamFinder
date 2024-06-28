<?php
require_once('src/components/movieCard.php');
require_once('src/php/connection.php');

function insertContent(){
    global $connect;
    try {
        $consult = $connect->prepare('SELECT * FROM movies UNION SELECT * FROM series');
        $consult->execute();
    
        $results = $consult->fetchAll();
    
        foreach($results as $item) {
            insertCard($item['title']);
        }
    
    } catch(PDOException $e) {
        echo 'Error' . $e->getMessage();
    }
}
?>