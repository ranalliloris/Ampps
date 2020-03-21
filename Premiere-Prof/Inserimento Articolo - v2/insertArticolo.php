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
                $query='INSERT INTO articoli SET
                NumArt=:numArt,
                descrizione=:desc,
                giacenza=:giacenza,
                categoria=:cat,
                magazzino=:magazzino,
                PrzUnitario=:prezzoU';
                $prep=$db->prepare($query);
                $prep->bindParam(":numArt",$_POST["numArt"],PDO::PARAM_STR, 4);
                $prep->bindParam(":desc",$_POST["desc"]);
                $prep->bindParam(":giacenza",$_POST["giacenza"]);
                $prep->bindParam(":cat",$_POST["cat"]);
                $prep->bindParam(":magazzino",$_POST["magazzino"]);
                $prep->bindParam(":prezzoU",$_POST["prezzoU"]);
                $prep->execute();
                echo "<h1>Articolo Inserito con successo</h1>";
                
            }
            catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }
?>