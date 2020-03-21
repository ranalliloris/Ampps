<html>
    <head>
        <title>Articolo Inserito</title>
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
                /*$query='INSERT INTO articoli SET
                NumArt="'.$_POST["numArt"].'",
                descrizione="'.$_POST["desc"].'",
                giacenza='.$_POST["giacenza"].',
                categoria="'.$_POST["cat"].'",
                magazzino="'.$_POST["magazzino"].'",
                PrzUnitario='.$_POST["prezzoU"];
                $pStat=$db->prepare($query);*/

                $query='INSERT INTO articoli SET
                NumArt=:numArt,
                descrizione=:desc,
                giacenza=:giacenza,
                categoria=:cat,
                magazzino=:magazzino,
                PrzUnitario=:prezzoU
                ';
                $pStat=$db->prepare($query); //PDOStatement
                $pStat->bindParam(":numArt",$_POST["numArt"]); //Associa al segnaposto :numArt il valore contenuto nell'arrat $_POST["numArt"]
                $pStat->bindParam(":desc",$_POST["desc"]);
                $pStat->bindParam(":giacenza",$_POST["giacenza"]);
                $pStat->bindParam(":cat",$_POST["cat"]);
                $pStat->bindParam(":magazzino",$_POST["magazzino"]);
                $pStat->bindParam(":prezzoU",$_POST["prezzoU"]);

                if($pStat->execute())
                {
                    echo "<h1>Articolo Inserito con successo</h1>";
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