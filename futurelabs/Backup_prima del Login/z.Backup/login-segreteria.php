<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-page.css?ts=<?=time()?>&quot">
    <!-- Bootstrap Show Password CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="icon" href="img/favicon.ico" />
    <title>Pagina di login riservata alla segreteria</title>
</head>
<body>
    
        <?php
        require_once "templates/session.php";
        require_once "templates/header.php";
        require_once "content/content-login-seg.php";
        require_once "templates/footer.php";
        ?>      
        <script src="js/event.js?<?php echo filemtime("js/event.js"); ?>"></script>
        <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>

</body>

</html>


