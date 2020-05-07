<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca vino per tipo e annata</title>
    <link href="../CSS/Style.css" rel="stylesheet">
</head>
<body>
    <h1>RICERCA FINO PER TIPO E PROVINCIA</h1>
    <form action="tipoProvincia.php" method="POST">
        <label>Tipo vino</label>
        <select name="tipo">
            <option value="Rosso">Rosso</option>
            <option value="Bianco">Bianco</option>
        </select>
        <br><br>
        
        <label>Provincia: </label>
        <select name="sigla">
        <?php
                try{
                    $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "christian", "christian");
                    echo "Connessione stabilita";
                }catch(PDOException $e){
                    echo "Errore: ".$e->getMessage();
                    die();
                }

                try
                {
                   $query= 'SELECT sigla
                            FROM province';
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
                        echo '<option value="'.$riga["sigla"].'">'.
                        $riga["sigla"].'</option>';
                    }
                }catch(PDOException $e)
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