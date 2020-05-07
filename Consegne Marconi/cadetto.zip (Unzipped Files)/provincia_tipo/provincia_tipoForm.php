<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Ordine</title>
</head>

<body>
    <form action="./provincia_tipo.php" method="POST">
    <label> Tipo vino </label>
        <select name="tipo">
            <option value="Rosso">Rosso</option>
            <option value="Bianco">Bianco</option>
        </select>
        <br><br>

        <label> Provincia </label>
        <select name="provincia" >
            <?php
            try{
                $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "userdb", "userdb");
                echo "Connessione stabilita";
            }catch(PDOException $e){
                echo "Errore: ".$e->getMessage();
                die();
            }
            try
            {
               $query= 'SELECT provincia, regione, sigla
                        FROM Province';
                $stmt=$db->prepare($query);
                if(!$stmt->execute())
                {
                    echo "Errore nell'esecuzione della query: ";
                    print_r($stmt->errorInfo());
                    die();
                }               
                $rows=$stmt->fetchAll();
                foreach($rows as $riga)
                {
                    echo '<option value="'.$riga["provincia"].'">
                    '.$riga["provincia"].'
                    '."(".'
                    '.$riga["sigla"].'
                    '.") - ".'
                    '.$riga["regione"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
        <br><br>

        <input type="submit" value="INVIA" />
        <input type="reset" value="RESETTA" />
    </form>
</body>

</html>