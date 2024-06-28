<?php
require_once('src/php/connection.php');
require_once('src/php/printContent.php');
require_once('src/components/movieCard.php');

try {
    global $connect;
    $gender = filter_var($_GET['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = '%' . $gender . '%';
    
    if (isset($_GET['type'])) {
        $tb = filter_var($_GET['type'], FILTER_SANITIZE_SPECIAL_CHARS);
    
        if (in_array($tb, ['movies', 'series'])) {
            $query = 'SELECT * FROM ' . $tb . ' WHERE gender LIKE :gender';
            $consult = $connect->prepare($query);
            $consult->execute(array(':gender' => $gender));
            $result = $consult->fetchAll();
        } 
    } else {
        $query = 'SELECT * FROM movies WHERE gender LIKE :gender UNION SELECT * FROM series WHERE gender LIKE :gender';
        $consult = $connect->prepare($query);
        $consult->execute(array(':gender' => $gender));
        $result = $consult->fetchAll();
    }


    if(isset($_GET['platform'])){
        $platform = filter_var($_GET['platform'], FILTER_SANITIZE_SPECIAL_CHARS);
        $itemsToPrint = array();

        //filter results for platform
        foreach($result as $item) {
            $platformsInItem = explode(", ", $item['platforms']);
            if(in_array($platform, $platformsInItem)) {
                $itemsToPrint[] = $item;
            } else {
                continue;
            }
        }

        //print filtered content
        if(!empty($itemsToPrint)){
            printContent($itemsToPrint);
        } else {
            echo '<h1 class="e404__text">No hay contenido para mostrar</h1>';
        }
    } else {
        printContent($result);
    }


} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>