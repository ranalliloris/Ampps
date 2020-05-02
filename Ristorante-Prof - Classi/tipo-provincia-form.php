<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca Vino per tipo e Provincia</title>
</head>
<body>
    <form action="./tipo-provincia.php" method="GET">
        <label>Tipo: </label>
        <select name="tipo">
            <option value="rosso">Vino Rosso</option>
            <option value="bianco">Vino Bianco</option>
        </select>
        <br><br>
        <label>Provincia: </label>
        <select name="provincia">
        <?php
        
        include __DIR__.'/classi/connectionDB.php';
        $dbconn=new dbConnect('localhost','lorisranalli','lorisranalli','ristorantemarconi');
        $dbconn->connect();

        try
        {
            
            $query="SELECT DISTINCT sigla
                    FROM province";
            
            $rows=$dbconn->query($query);
            foreach($rows as $row)
            {
                echo "<option value='".$row["sigla"]."'>".$row["sigla"]."</option>";
            }
        }
        catch(Exception $e)
        {
            echo "Errore nell'esecuzione della query: ".$e;
            die();
        }
        ?>
        </select>
        <br><br>
        <input type="submit" value="Cerca" />
    </form>
</body>
</html>