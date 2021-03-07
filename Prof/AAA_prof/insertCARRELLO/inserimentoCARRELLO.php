<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    
    <title>Aggiungo</title>
</head>
<body>
    <?php
        include __DIR__.'/../classi/dbConnect.php';
        $dbConn = new dbConnect('localhost', 'cadettocservice', 'userdb', 'userdb');
        $dbConn ->connect();

        try{
            //INSERT INTO `carrello`(`ID`, `idProdottoC`, `usernameUtenteC`, `quantita`)
            $values= [
                ":idProdottoC"=>$_POST["idProdottoC"],
                ":usernameUtenteC"=>$_POST["usernameUtenteC"],
                ":quantita"=>$_POST["quantita"]
            ];
            
            $stmt=$dbConn->insert('carrello',$values);
        }catch(PDOException $e)
        {
            echo "Errore nell'esecuzione della query: ".$e->getMessage();
        }
        ?>
</body>
</html>
</body>
</html>