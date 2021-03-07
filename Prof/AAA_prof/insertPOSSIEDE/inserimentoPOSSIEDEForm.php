<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assegnazione dispositivo</title>
</head>
<body>
    <form action="./inserimentoPOSSIEDE.php" method="POST">

    <label> Assegna il dispositivo </label>
        <select name="codiceSerialeP">
            <?php
            try{
                $db=new PDO("mysql:host=localhost; dbname=cadettocservice", "userdb", "userdb");
                echo "Connessione stabilita";
            }catch(PDOException $e){
                echo "Errore: ".$e->getMessage();
                die();
            }
            try
            {
               $query= 'SELECT codiceSeriale, marca
                        FROM dispositivo';
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
                    echo '<option value="'.$riga["codiceSeriale"].'">
                    '.$riga["codiceSeriale"].'
                    '." - ".'
                    '.$riga["marca"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
              
        <label> al dipendente </label>
        <select name="cfDipendenteP" >
            <?php
            try{
                $db=new PDO("mysql:host=localhost; dbname=cadettocservice", "userdb", "userdb");
                echo "Connessione stabilita";
            }catch(PDOException $e){
                echo "Errore: ".$e->getMessage();
                die();
            }
            try
            {
               $query= 'SELECT CF, dipendente.nome as nomeD, cognome, codiceEdificioD, descrizione, sede.nome as nomeS
                        FROM dipendente, edificio, sede
                        WHERE dipendente.codiceEdificioD = edificio.codice AND edificio.idSedeE = sede.ID';
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
                    echo '<option value="'.$riga["CF"].'">
                    '." CF: ".'
                    '.$riga["CF"].'
                    '." - Nome dipendente: ".'
                    '.$riga["nomeD"].'
                    '." - Cognome dipendete:  ".'
                    '.$riga["cognome"].'
                    '." - Codice edificio: ".'
                    '.$riga["codiceEdificioD"].'
                    '." - Edificio: ".'
                    '.$riga["descrizione"].'
                    '." - Nome sede: ".'
                    '.$riga["nomeS"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
        <br><br>

        <label> Dal giorno </label>
        <input type="date" name="dataInizio" required/>

        <label> al giorno </label>
        <input type="date" name="dataFine" required/>
        <br><br>

        <input type="submit" value="INVIA" />
        <input type="reset" value="RESETTA" />
    </form>
</body>
</html>