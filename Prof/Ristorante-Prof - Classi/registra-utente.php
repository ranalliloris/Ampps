<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esito Registrazione</title>
</head>
<body>
    <?php
        include __DIR__.'/classi/connectionDB.php';
        $dbconn=new dbConnect('localhost','userdb','userdb','ristorantemarconi');
        $dbconn->connect();
        
        try
        {
            if($dbconn->userExists())
            {
                echo "<h1>Registrazione non effettuata: Utente già registrato</h1>";
                die();
            }
            $dbconn->nuovoUtente();
            echo "<h1> Registrazione utente avvenuta con successo</h1>";
        }
        catch(Exception $e)
        {
            echo "Errore nell'esecuzione della query: ".$e;
            die();
        }
            
    ?>
</body>
</html>

