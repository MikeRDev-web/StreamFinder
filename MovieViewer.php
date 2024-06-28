<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/movieCard.css">
    <link rel="stylesheet" href="src/styles/movieViewer.css">
    <link rel="stylesheet" href="src/resources/icons/logo.svg">
    <?php require_once('src/components/fontAndStyle.php'); ?>
    <title>StreamFinder</title>
</head>

<body>
    <!--Header-->
    <?php require_once('src/components/header.php'); ?>
    <main class="specialMain2">
        <?php
        require_once('src/php/connection.php');
        $item = filter_var($_GET['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        try {
            $consult = $connect->prepare('
            SELECT * FROM movies WHERE title = :stm
            UNION
            SELECT * FROM series WHERE title = :sts
            ');
            $consult->execute(array(':stm' => $item, ':sts' => $item));

            $itemFind =  $consult->fetch(PDO::FETCH_ASSOC);

            //print content
            echo '<img src="src/resources/icons/back.svg" class="back__arrow" id="backBtn" title="Ir atrás">';
            echo '<h1 class="itemTitle">'. $itemFind['title'] .'</h1>';
            echo '<div class="item__info">';
            echo '<img src="src/resources/covers/'. $itemFind['poster'] .'" alt="portada" class="item__info-img">';
            echo '<span class="item__info-details">';
            echo '<h3 class="item__info-details-synopsis">'. $itemFind['synopsis'] .'</h3>';
            if (is_numeric($itemFind['duration'])) {
                echo '<p class="item__info-details-specificDetail"><span>Duración:</span> ' . htmlspecialchars($itemFind['duration']) . ' minutos</p>';
            } else {
                echo '<p class="item__info-details-specificDetail"><span>Duración:</span> ' . htmlspecialchars($itemFind['duration']) . '</p>';
            }
            echo ' <p class="item__info-details-specificDetail"><span>Género:</span> '. htmlspecialchars($itemFind['gender']) .'</p>';
            echo '<p class="item__info-details-specificDetail"><span>Año:</span> '. htmlspecialchars($itemFind['year']) .'</p>';
            echo '<p class="item__info-details-specificDetail"><span>Director:</span> '. htmlspecialchars($itemFind['director']) .'</p>';
            echo '<div class="item__info-details-platforms">';
            echo '<h2>¿Donde lo puedo ver?</h2>';
            echo '<span class="platfomrs">';
            $platdormsAvailable = $itemFind['platforms'];
            $platdormsAvailable = explode(', ', $platdormsAvailable);
            foreach($platdormsAvailable as $paltform){
                echo '<div class="platform">';
                echo '<img src="" alt="Plataforma" class="platform__icon" data-platform-id="'. $paltform .'">';
                echo '<p class="platform__name">'. $paltform .'</p>';
                echo '</div>';
            }
            echo '</span>';
            echo '</div>';
            echo '</span>';
            echo '</div>';
            echo '<div class="trailerContainer">';
            echo '<h1 class="itemTitle">Trailer</h1>';
            echo ' <iframe width="560" height="315" src="'. $itemFind['trailer'] .'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="trailer__video"></iframe>';
            echo ' </div>';
            echo '<div class="relatedContendContainer">';
            echo '<h1 class="itemTitle">Contenido similar</h1>';
            echo '<span class="relatedContentCards">';

            $gender = filter_var($itemFind['gender'], FILTER_SANITIZE_SPECIAL_CHARS);

            $genders = explode('/', $gender);

            $conditions = [];
            $params = [];
            foreach ($genders as $index => $term) {
                $key = ':term' . $index;
                $conditions[] = "gender LIKE $key";
                $params[$key] = '%' . $term . '%';
            }

            $whereClause = implode(' OR ', $conditions);

            // Prepare consult
            $query = "
                SELECT * FROM movies WHERE $whereClause
                UNION
                SELECT * FROM series WHERE $whereClause
            ";

            $relatedContentConsult = $connect->prepare($query);
            $relatedContentConsult->execute($params);

            $relatedContent = $relatedContentConsult->fetchAll();

            require_once('src/components/movieCard.php');

          
                foreach ($relatedContent as $item) {
                    if($item['title'] == $itemFind['title']) {
                        continue;
                    } else {
                        insertCard($item['title']);
                    }
                }
            
            
            echo '</span>';
            echo '</div>';

        } catch(PDOException $e) {
            echo 'Error:' . $e->getMessage();
        }
        ?> 
    </main>
    <script src="src/js/header.js"></script>
    <script src="src/js/cards.js"></script>
    <script src="src/js/platforms.js"></script>
    <script>
        const backBtn = document.querySelector('.back__arrow');

        backBtn.addEventListener('click', ()=>{
            window.history.back();
        });
    </script>
</body>

</html>