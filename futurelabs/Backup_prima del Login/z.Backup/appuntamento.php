<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-page.css">
    <link rel="icon" href="img/favicon.ico" />
    <title>Prenotazioni Segreteria Da Vinci</title>
</head>
<body onload="onLoadAppuntamento()">
    
        <?php
        require_once "php/function/funDate.php";
        require_once "templates/session.php";
        require_once "templates/header.php";
        require_once "inc/info_glob.inc.php";
        $today=new DateTime();
        $today=$today->format('d-m-Y');
        if(dataPrenotabile($today,$data_inizio_pren,$data_fine_pren) || $reserved)
        {
            require_once "content/content-appuntamento.php";
        }
        else
        {
            echo '<h3 class="text-danger">Non è più possibile prenotare appuntamenti. Si prega di contattare la segreteria didattica</h3>';
        }
        require_once "templates/footer.php";

        ?>
        <script src="js/event.js?<?php echo filemtime("js/event.js"); ?>"></script>
</body>
</html>



