<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assegnazione orario</title>
</head>
<body>
    <form action="./inserimentoRISPETTA.php" method="POST">

    <label> Assegna orario n° </label>
        <select name="idOrarioR">
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
               $query= 'SELECT ID, ora_Inizio, ora_Fine, giornoSett
                        FROM orario';
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
                    echo '<option value="'.$riga["ID"].'">
                    '.$riga["ID"].'
                    '." - ".'
                    '.$riga["ora_Inizio"].'
                    '." - ".'
                    '.$riga["ora_Fine"].'
                    '." - ".'
                    '.$riga["giornoSett"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
              
        <label> al dipendente </label>
        <select name="cfDipendenteR" >
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

        <input type="submit" value="INVIA" />
        <input type="reset" value="RESETTA" />
    </form>
</body>
</html>