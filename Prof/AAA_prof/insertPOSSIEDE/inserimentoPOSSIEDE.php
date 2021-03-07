<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    
    <title>inserimento</title>
</head>
<body>
    <?php
        include __DIR__.'/../classi/dbConnect.php';
        $dbConn = new dbConnect('localhost', 'cadettocservice', 'userdb', 'userdb');
        $dbConn ->connect();

        try{
            //INSERT INTO `possiede`(`codiceSerialeP`, `cfDipendenteP`, `dataInizio`, `dataFine`)
            $values= [
                ":codiceSerialeP"=>$_POST["codiceSerialeP"],
                ":cfDipendenteP"=>$_POST["cfDipendenteP"],
                ":dataInizio"=>$_POST["dataInizio"],
                ":dataFine"=>$_POST["dataFine"]
            ];
            
            $stmt=$dbConn->insert('possiede',$values);
        }catch(PDOException $e)
        {
            echo "Errore nell'esecuzione della query: ".$e->getMessage();
        }
        ?>
</body>
</html>
</body>
</html>