<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione Utente</title>
</head>
<body>
    <?php
        include __DIR__.'/classi/dbConnect.php';
        $dbConn=new dbConnect('localhost','ristorantemarconi','userdb','userdb');
        $db=$dbConn->connect();

        $values=[
                    ":username"=>$_POST["username"], 
                    ":password"=> password_hash($_POST["password"],PASSWORD_DEFAULT),
                    ":cognome"=>$_POST["cognome"], 
                    ":nome"=>$_POST["nome"], 
                    ":email"=>$_POST["email"],
                    ":telefono"=>$_POST["telefono"],
                    ":indirizzo"=>$_POST["indirizzo"],
                    ":numeroCivico"=>$_POST["numeroCivico"],
                    ":cap"=>$_POST["cap"],
                    ":citta"=>$_POST["citta"],
                    ":provincia"=>$_POST["provincia"]           
                ];
        $stmt=$dbConn->insert("utente",$values);
        echo"<h1>Inserimento avvenuto con successo</h1>"
    ?>
</body>
</html>