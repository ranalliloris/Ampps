<html>
    <head>
        <title>Ricerca Completa</title>
    </head>
    <body>
        <?php
            try
            {
                $db=new PDO('mysql:host=localhost; dbname=ristorantemarconi','user','user');
               
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo 'Connessione non riuscita\n'.$e;
                die();
            }
            
            try
            {
                
                $query= 'SELECT Vino, Tipo, Cantina, Provincia
						FROM Vini As V 
						WHERE V.Regione ="'.$_POST["regione"];
                $pStat=$db->prepare($query);
                if($pStat->execute())
                {
                    echo "<h1></h1>";
                }
                else
                {
                    print_r($pStat->errorInfo);
                }
				
				$rows=$pStat->fetchAll();
                echo "<table>";

                foreach($rows as $riga)
                {
                    echo "<tr>";
                    echo "<td>".$riga['Vino']."</td>";
					echo "<td>".$riga['Tipo']."</td>";
                    echo "<td>".$riga['Cantina']."</td>";
                    echo "<td>".$riga['Provincia']."</td>";
                    echo "</tr>";
                }

                echo "</table>";
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