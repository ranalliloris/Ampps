<?php
session_start();
//semplice controllo di sessione, controllo solo se è gia presente la chiave username nella
//sessione in tal caso l'utente è loggato e può visualizzare i link alle pagine riservate
if(isset($_SESSION["username"]))
    $reserved=true;
else
    $reserved=false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Ristorante Marconi - Scelta Vino</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');
        #content
        {
            width:60%
        }

        #left-sidebar, #right-sidebar
        {
            width:20%;
            height:50%;
        }

        #header
        {
            margin: 0 0 35px 0px;
            font-family: 'Dancing Script', cursive;
            color:#51008f;
        }
    #img-header
    {
        padding:0 20% 0 20%;
    }
    </style>
</head>
<body>
    <div  class="container">
        <img id="img-header" class="img-fluid rounded" src="./img/sfondo.jpg">
        <div id="header">
            <h1 class="text-center">Carta dei Vini Ristorante Marconi</h1>
        </div>
        
        <div id="left-sidebar" class="float-left">
            <img src="./img/rosso.jpg" class="img-fluid rounded">
        </div>
        <div id="content" class="float-left">
    
            <a class="btn btn-primary btn-lg btn-block" href="./tipo-annata.html">Ricerca Vino per tipo e annata</a><br>
            <a class="btn btn-primary btn-lg btn-block" href="./regione.html">Ricerca Vino per Regione</a> <br>
            <a  class="btn btn-primary btn-lg btn-block" href="./tipo-provincia-form.php">Ricerca Vino per tipo e provincia</a> <br>
            
            
        <?php
            if($reserved)
            {
                //collegamento alla pagina carello che non esiste
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./carrello.html">Carrello</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./logout.php">Logout</a> <br>';
            }
            else
            {
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./login.html">Login</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./registra-utente.html">Registra Utente</a> <br>';
            }
        ?>
        </div>
        <div id="right-sidebar" class="float-right">
            <img src="./img/bianco.jpg" class="img-fluid rounded">        
        </div>
    </div>

</body>
</html>