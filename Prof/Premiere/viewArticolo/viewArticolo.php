<html>
    <head>
        <title>Lista Articoli</title>
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
                //SELEZIONARE TUTTI GLI ARTICOLI
                $query=' SELECT *
                         FROM Articoli';
                $pStat=$db->prepare($query);

                if(!$pStat->execute())
                {
                   echo "Errore: ";
                   print_r($pStat->errorInfo());
                   die(); 
                }

                $rows=$pStat->fetchAll(); //Restituisce tutte le righe risultato della query
                echo "<table>";

                foreach($rows as $riga)
                {
                    echo "<tr>";
                    echo "<td>".$riga['NumArt']."</td>";
                    echo "<td>".$riga['descrizione']."</td>";
                    echo "<td>".$riga['PrzUnitario']."</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
            catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }
        ?>
    </body>
</html>