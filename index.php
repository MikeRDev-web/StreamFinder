<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('src/components/fontAndStyle.php'); ?>
    <title>StreamFinder</title>
</head>

<body>
    <!--Header-->
    <?php require_once('src/components/header.php'); ?>
    <!--Nav-->
    <?php require_once('src/components/navbar.php'); ?>
    <main>
        <link rel="stylesheet" href="src/styles/movieCard.css">
        <?php
            if (isset($_GET['gender'])) {
                require 'src/components/genderFilter.php';
            } elseif (isset($_GET['platform'])) {
                require 'src/components/platformFilter.php';
            } elseif (isset($_GET['type'])) {
                if ($_GET['type'] === 'movies') {
                    require 'src/components/allMovies.php';
                } elseif ($_GET['type'] === 'series') {
                    require 'src/components/allSeries.php';
                } else {
                    require 'notfound.php';
                }
                if (!isset($_GET['gender'])) {
                    insertContent();
                }
            } else {
                require 'src/components/allContent.php';
                insertContent();
            }
        ?>
    </main>
    <script src="src/js/navbar.js"></script>
    <script src="src/js/header.js"></script>
    <script src="src/js/cards.js"></script>
</body>

</html>