<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    
    <title>assegnazione</title>
</head>
<body>
    <?php
        include __DIR__.'/../classi/dbConnect.php';
        $dbConn = new dbConnect('localhost', 'cadettocservice', 'userdb', 'userdb');
        $dbConn ->connect();

        try{
            //INSERT INTO `rispetta`(`idOrarioR`, `cfDipendenteR`)
            $values= [
                ":idOrarioR"=>$_POST["idOrarioR"],
                ":cfDipendenteR"=>$_POST["cfDipendenteR"]
            ];
            
            $stmt=$dbConn->insert('rispetta',$values);
        }catch(PDOException $e)
        {
            echo "Errore nell'esecuzione della query: ".$e->getMessage();
        }
        ?>
</body>
</html>
</body>
</html>