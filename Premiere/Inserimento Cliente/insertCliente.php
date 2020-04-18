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
            {   //INSERT INTO `clienti`(`CodC`, `cognome`, `nome`, `via`, `citta`, `prov`, `cap`, `saldo`, `fido`, `CodR`) VALUES 
                 $query='INSERT INTO clienti
                        VALUES(:CodC, :cognome, :nome, :via, :citta, :prov, :cap, :saldo, 
                        :fido, :CodR)';
                 $pStat=$db->prepare($query); //PDOStatement
                 $pStat->bindParam(":CodC",$_POST["CodC"]); //Associa al segnaposto :numArt il valore contenuto nell'arrat $_POST["numArt"]
                 $pStat->bindParam(":cognome",$_POST["cognome"]);
                 $pStat->bindParam(":nome",$_POST["nome"]);
                 $pStat->bindParam(":via",$_POST["via"]);
                 $pStat->bindParam(":citta",$_POST["citta"]);
                 $pStat->bindParam(":prov",$_POST["prov"]);
                 $pStat->bindParam(":cap",$_POST["cap"]);
                 $pStat->bindParam(":saldo",$_POST["saldo"]);
                 $pStat->bindParam(":fido",$_POST["fido"]);
                 $pStat->bindParam(":CodR",$_POST["CodR"]);
                if($pStat->execute())
                {
                    echo "<h1>Cliente Inserito con successo</h1>";
                }
                else
                {
                    print_r($pStat->errorInfo()); //Mostra l'errore nell'esecuzione della query.
                }
                
                
            }
            catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }
        ?>
    </body>
</html>