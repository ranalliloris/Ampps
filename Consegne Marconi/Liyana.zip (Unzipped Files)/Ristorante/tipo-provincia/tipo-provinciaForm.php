<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca Vino per Tipo e Provincia</title>
</head>
<body>
    <h1>Ricerca Vino per Tipo e Provincia</h1>
    <form action="./tipo-provincia.php" method="POST">
        <label>Tipo Vino: </label>
        <select name="tipo">
            <option value="Rosso">Rosso</option>
            <option value="Bianco">Bianco</option>
        </select>
        <br><br>
        <label>Provincia: </label>
        <select name="provincia">
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
                    $query='SELECT provincia
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
                        echo '<option value="'.$riga["provincia"].'">'
                            .$riga["provincia"].
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