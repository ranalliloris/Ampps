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
                /*** Preparo la query da eseguire ***/
                $query='Select NumArt, descrizione, PrzUnitario
                From articoli';
                
                echo "<table>";
                $pStat=$db->prepare($query);
                $pStat->execute();
                $rows=$pStat->fetchAll();
                foreach($rows as $row)
                {
                    echo "<tr>";
                    echo "<td>".$row['NumArt']."</td>";
                    echo "<td>".$row['descrizione']."</td>";
                    echo "<td>".$row['PrzUnitario']."</td>";
                    echo"</tr>";
                }
                echo "</table>";
           
                
            }
            catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage()." nel file ".$e->getFile()."Linea: ".$e->getLine();
                die();
            }
        ?>
    </body>
</html>