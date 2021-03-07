<html>
    <head>
        <title>Cliente Inserito</title>
    </head>
   <body>
        <?php
            try
            {
                $db=new PDO('mysql:host=localhost; dbname=premiere','lorisranalli','lorisranalli');
                /*L'istruzione successiva attiva la segnalazione di errori di esecuzione
                delle query*/
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo 'Connessione non riuscita\n'.$e;
                die();
            }
            try
            {
                /*** Preparo la query da eseguire ***/
                $query='INSERT INTO clienti VALUES
                (:CodC, :cognome, :nome, :via, :citta, :prov, :cap, :saldo, :fido, :CodR)';
                $pStat=$db->prepare($query);
                
                $pStat->bindParam(":CodC",$_POST["CodC"],PDO::PARAM_STR, 4);
                $pStat->bindParam(":cognome",$_POST["cognome"]);
                $pStat->bindParam(":nome",$_POST["nome"]);
                $pStat->bindParam(":via",$_POST["via"]);
                $pStat->bindParam(":citta",$_POST["citta"]);
                $pStat->bindParam(":prov",$_POST["prov"]);
                $pStat->bindParam(":cap",$_POST["cap"]);
                $pStat->bindParam(":saldo",$_POST["saldo"]);
                $pStat->bindParam(":fido",$_POST["fido"]);
                $pStat->bindParam(":CodR",$_POST["CodR"]);
                
                if(!$pStat->execute())
                {
                    echo "Errore nell'esecuzione della query: ";
                    print_r($pStat->errorInfo());
                }
                echo "<h1>Cliente Inserito con successo</h1>";
                
            }
            catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }?>
    </body>
</html>