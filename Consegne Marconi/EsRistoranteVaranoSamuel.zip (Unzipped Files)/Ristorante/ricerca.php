<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato Ricerca</title>
</head>
<body>
    
    <table border="1">
    		<thead>
    			<tr>
    				<th>Nome del Vino</th>
    				<th>Cantina</th>
    				<th>Provincia</th>
    			</tr>
    		</thead>
    		<tbody>
    </table>


    <?php
    	try
    	{
            $db=new PDO("mysql:host = localhost; dbname = ristorantemarconi", "lorisranalli", "lorisranalli");
            echo "Connessione stabilita";
        }
        catch(PDOException $e)
        {
            echo "Errore: ".$e->getMessage();
            die();
        }

        try
        {
        	$quey="SELECT v.nomeVino, c.nome, c.provinvia
        		   FROM vino AS v 
                        INNER JOIN cantina AS c
                    	   ON v.idCantina = c.id
                        INNER JOIN provincia AS p
                           ON p.sigla = c.provincia
        		   WHERE p.regione = 'Piemonte'
        	";
        	$stmt=$db->prepare($query);

			if(!$stmt->execute())
			{
				echo "Errore nell'esecuzione della query: ";
				print_r($stmt->errorInfo());
			}  

			$rows=$stmt->fetchAll();
			foreach($rows as $riga)
			{
				echo "<tr>";
                echo "<td>".$riga["tipoVino"]."</td>";
				echo "<td>".$riga["nomeVino"]."</td>";
				echo "<td>".$riga["nome"]."</td>";
				echo "<td>".$riga["provincia"]."</td>";
            	echo "</tr>";
			}

        }
        catch(Exception $e)
        {
        	echo "Errore durante l'esecuzione della query: ".$e;
        }
    ?>

    </tbody>    
</body>
</html>