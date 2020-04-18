<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Cliente</title>
</head>
<body>
    <form action="insertCliente.php" method="POST">
        <label>Codice Cliente: </label>
        <input type="text" name="CodC" />
        <br><br>
        
        <label>Cognome: </label>
        <input type="text" name="cognome" />
        <br><br>
        
        <label>Nome: </label>
        <input type="text" name="nome" />
        <br><br>

        <label>via: </label>
        <input type="text" name="via" />
        <br><br>

        <label>Città: </label>
        <input type="text" name="citta" />
        <br><br>

        <label>Prov.: </label>
        <input type="text" name="prov" />
        <br><br>

        <label>CAP: </label>
        <input type="text" name="cap" />
        <br><br>

        <label>Saldo: </label>
        <input type="number" name="saldo" step="0.01" />
        <br><br>

        <label>Fido: </label>
        <input type="number" name="fido" step="0.01" />
        <br><br>

        <label>Rappresentante: </label>
       <select name="CodR">
        <?php
            try
            {
                $db=new PDO("mysql:host=localhost; dbname=premiere",'lorisranalli','lorisranalli');

            }
            catch(PDOException $e)
            {
                echo "Connessione non riuscita ".$e;
                die();
            }

            try
            {
                $query='SELECT CodR, cognome, nome
                        FROM rappresentanti';
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
                    // <option value="volvo">03 Ranalli Loris</option>
                    echo '<option value="'.$riga["CodR"].'">'
                        .$riga["CodR"].' '.$riga["cognome"].' '.$riga["nome"].
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
       <input type="submit" value="Salva" />
       <input type="reset" value="Cancella" />     
    </form>
</body>
</html>