<?php
require_once('src/php/connection.php');
require_once('src/components/movieCard.php');
require_once('src/php/printContent.php');


try {
    global $connect;

    if(isset($_GET['platform'])) {
        $platform = filter_var($_GET['platform'], FILTER_SANITIZE_SPECIAL_CHARS);
        $type = isset($_GET['type']) ? filter_var($_GET['type'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
    
        $platform = '%' . $platform . '%';
    
        if ($type) {
            if ($type == 'movies') {
                $query = 'SELECT * FROM movies WHERE platforms LIKE :term';
                $params = array(':term' => $platform);
            } else if ($type == 'series') {
                $query = 'SELECT * FROM series WHERE platforms LIKE :term';
                $params = array(':term' => $platform);
            } else {
                $query = 'SELECT * FROM movies WHERE platforms LIKE :term UNION SELECT * FROM series WHERE platforms LIKE :term';
                $params = array(':term' => $platform);
            }
        } else {
            $query = 'SELECT * FROM movies WHERE platforms LIKE :term UNION SELECT * FROM series WHERE platforms LIKE :term';
            $params = array(':term' => $platform);
        }
    
        $consult = $connect->prepare($query);
        $consult->execute($params);
        
        $resultConsult = $consult->fetchAll();
        
        printContent($resultConsult);
    } 


} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>