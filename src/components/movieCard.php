<?php
require_once('src/php/connection.php');

function insertCard($contentCard)
{
    global $connect;
    try {
        //database consult
        $consult = $connect->prepare('SELECT * FROM movies WHERE title = :title UNION SELECT * FROM series WHERE title = :title');
        $consult->execute(array(':title' => $contentCard));

        $result = $consult->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            //print not found element
            echo '<p class="movieCard IGGM">404</p>';
        } else {
            //print found element
            echo '<a href="MovieViewer.php?title='. htmlspecialchars($result['title']) .'" class="movieCard">';
            echo '<img src="src/resources/covers/' . htmlspecialchars($result['poster']) . '" alt="poster" class="movieCard__poster">';
            echo '<span class="movie__details">';
            echo '<p class="movieCard__title">' . htmlspecialchars($result['title']) . '</p>';
            echo '<p class="movieCard__gender">' . htmlspecialchars($result['gender']) . '</p>';
            echo '</span>';
            echo '</a>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>