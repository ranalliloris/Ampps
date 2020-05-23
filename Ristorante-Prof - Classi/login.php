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
            }
            else
            {
                echo "<h1>Password Errata</h1>";
            }
        }
    ?>
</body>
</html>