<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca Vino per Regione</title>
</head>
<body>
    <h1>Ricerca Vino per Regione</h1>
    <form action="./regione.php" method="POST">
        <label>Regione: </label>
        <select name="regione">
            <?php
                try
                {
                    $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi",'userdb','userdb');
    
                }
                catch(PDOException $e)
                {
                    echo "Connessione non riuscita ".$e;
                    die();
                }
    
                try
                {
                    $query='SELECT regione
                            FROM province';
                    $pStat=$db->prepare($query);
    
                    if(!$pStat->execute())
                    {
                        echo "Errore nell'esecuzione della query: ";
                        print_r($pStat->errorInfo());
                        die();
                    }
    
                    $rows=$pStat->fetchAll();
                    foreach($rows as $riga)
                    {
                        echo '<option value="'.$riga["regione"].'">'
                            .$riga["regione"].
                            '</option>';
                    }  
    
                }
                catch(PDOException $e)
                {
                    echo "Errore: ".$e;
                }
    
            ?>
           </select> 
        <br><br>
        <input type="submit" value="Cerca"> 
    </form>
</body>
</html>