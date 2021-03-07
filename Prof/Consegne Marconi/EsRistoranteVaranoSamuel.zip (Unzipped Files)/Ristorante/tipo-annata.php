<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato Ricerca Annata-Tipo</title>
</head>
<body>
    <h1>

        <?php
            if ($_POST["tipo"] == "Rosso")
            {
                $tipo = "rossi";
            }

            else {
                $tipo = "bianchi";
            }
            echo "Lista dei Vini ".$_POST["tipo"]."dell'annata ".$_POST["annata"].":";
        ?>
    </h1>

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
                $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "lorisranalli", "lorisranalli");
                echo "Connessione stabilita";
            }
            catch(PDOException $e)
            {
                echo "Errore: ".$e->getMessage();
                die();
            }

            try
            {
            	$quey=" SELECT v.nomeVino, c.nome, c.provinvia
            		    FROM vino AS v 
                            INNER JOIN cantina AS c
            		   		    ON v.idCantina=c.idCantina
            		    WHERE tipoVino=:tipo AND annata_:annata
            	";
            	$stmt=$db->prepare($query);

        		$stmt->bindParam(":tipo",$_POST["tipo"]);
        		$stmt->bindParam(":annata",$_POST["annata"]);

        		if(!$stmt->execute())
        		{
        			echo "Errore nell'esecuzione della query: ";
        			print_r($stmt->errorInfo());
        		}  

        		$rows=$stmt->fetchAll();
        		foreach($rows as $riga)
        		{
        			echo "<tr>";
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