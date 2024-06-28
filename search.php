<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/styles/movieCard.css">
    <?php require_once('src/components/fontAndStyle.php'); ?>
    <title>StreamFinder</title>
</head>

<body>
    <!--Header-->
    <?php require_once('src/components/header.php'); ?>
    <main class="specialMain">
       <?php
       $searchTerm = $_GET['search'];
       
       if($searchTerm === ''){
           echo '<h1 class="notValideSearch">Por favor ingresa un termino de busqueda</h1>';
          
       } else {
           require_once('src/php/connection.php');
           try {
               $consult = $connect->prepare('
                   SELECT * FROM movies WHERE title LIKE :stm
                   UNION
                   SELECT * FROM series WHERE title LIKE :sts
               ');
               $stm = "%" . $searchTerm . "%";
               $sts = "%" . $searchTerm . "%";
               $consult->execute(array(':stm' => $stm, ':sts' => $sts));
           
               $result = $consult->fetchAll(PDO::FETCH_ASSOC);
           
               if (!empty($result)) { 
                    require_once('src/components/movieCard.php');
                   foreach($result as $item) {
                    insertCard($item['title']);
                   }
               } else {
                   echo '<h1>No hay resultados para: ' . htmlspecialchars($searchTerm) . '</h1>';
               }
           } catch (PDOException $e) {
               echo 'Error: ' . $e->getMessage();
           }
       }
       ?>
    </main>
    <script src="src/js/header.js"></script>
    <script src="src/js/cards.js"></script>
</body>

</html>