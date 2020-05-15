<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esito Inserimento Provincia</title>
</head>
<body>
    <?php
        include __DIR__.'/classi/dbConnect.php';
        $dbConn=new dbConnect('localhost','ristorantemarconi','userdb','userdb');
        $db=$dbConn->connect();
        
        try
        {
           /* $query='INSERT INTO province
            VALUES(:sigla,:provincia,:regione)';*/
        
            $values=[
                ':sigla'=>$_POST["sigla"],
                ':provincia'=>$_POST["provincia"],
                ':regione'=>$_POST["regione"]
            ];

            $stmt=$dbConn->insert('province',$values);
        }
        catch(Exceptio $e)
        {
            echo "Errore nell'esecuzione della query: ".$e;
            die();
        }
    ?>    
</body>
</html>
