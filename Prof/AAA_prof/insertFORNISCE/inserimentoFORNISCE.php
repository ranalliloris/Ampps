<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    
    <title>richiesta</title>
</head>
<body>
    <?php
        include __DIR__.'/../classi/dbConnect.php';
        $dbConn = new dbConnect('localhost', 'cadettocservice', 'userdb', 'userdb');
        $dbConn ->connect();

        try{
            //INSERT INTO `fornisce`(`pivaFornitoreF`, `idFornituraF`, `data`, `quantita`)
            $values= [
                ":pivaFornitoreF"=>$_POST["pivaFornitoreF"],
                ":idFornituraF"=>$_POST["idFornituraF"],
                ":data"=>$_POST["data"],
                ":quantita"=>$_POST["quantita"]
            ];
            
            $stmt=$dbConn->insert('fornisce',$values);
        }catch(PDOException $e)
        {
            echo "Errore nell'esecuzione della query: ".$e->getMessage();
        }
        ?>
</body>
</html>
</body>
</html>