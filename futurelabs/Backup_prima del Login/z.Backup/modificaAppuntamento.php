<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-page.css">
    <link rel="icon" href="img/favicon.ico" />
    <title>Modifica/Cancellazione Appuntamento</title>
</head>
<body onload="onLoadModAppuntamento()">
    
        <?php

        require_once "templates/session.php";
        require_once "templates/header.php";
        require_once "content/content-modifica-app.php";
        require_once "templates/footer.php";

        ?>
        <script src="js/modifica-app.js?<?php echo filemtime("js/event.js"); ?>"></script> 
</body>
</html>