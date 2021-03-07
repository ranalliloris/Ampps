<?php
//avvio la sessione
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Utente</title>
</head>
<body>
    <?php
        include __DIR__.'/classi/connectionDB.php';
        $dbConn=new dbConnect('localhost','userdb','userdb','ristorantemarconi');
        $dbConn->connect();

        if(!$dbConn->userExists())
        {
            echo "<h1>Utente non trovato</h1>";
        }
        else
        {
            if($dbConn->userVerify())
            {
                echo "<h1>Benvenuto ".$_POST["username"]."</h1>";
                //Memorizzo una nuova variabile nella sessione
                $_SESSION["username"]=$_POST["username"];
                echo "Verrai reinderizzato alla homepage tra 3 sec";
                //reindirizzo dopo 3 secondi verso la pagina index.php
                header("refresh:3;url=./index.php");
            }
            else
            {
                echo "<h1>Password Errata</h1>";
                echo "Verrai reinderizzato alla pagina di login tra 3 sec";
                //reindirizzo dopo 3 secondi verso la pagina login.html
                header("refresh:5;url=./login.html");
            }
        }
    ?>
</body>
</html>