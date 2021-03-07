<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca vino per regione</title>
    <link href="../CSS/Style.css" rel="stylesheet">
</head>
<body>
    <h1>RICERCA VINO PER REGIONE</h1>
    <form action="regione.php" method="POST">
        <label>Regione</label>
        <select name="regione">
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
                   $query= 'SELECT regione
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
                        echo '<option value="'.$riga["regione"].'">'.
                        $riga["regione"].'</option>';
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