<!DOCTYPE html>
<html>
<head>
	<title>Risultato della ricerca</title>
</head>
<body>
	
	<table border="1">
		<thead>
			<tr>
                <th>Tipo del Vino</th>
				<th>Nome del Vino</th>
				<th>Cantina</th>
				<th>Provincia</th>
			</tr>
		</thead>
		<tbody>

	<?php


	try{
            $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "faur", "rumenaccio");
            echo "Connessione stabilita";

        }catch(PDOException $e){
            echo "Errore: ".$e->getMessage();
            die();
        }

        try {
		$query="SELECT V.nomeVino, V.nome, C.provincia
		FROM vino as V INNER JOIN cantina as C on V.idCantina=C.id
                INNER JOIN provincia AS P on P.sigla=C.provincia
		WHERE P.regione='Sicilia'";
		$stmt=$db->prepare($query);

		
		if (!$stmt->execute()) {
			echo "Errore nell' esecuzione: ";
			print_r($stmt->errorInfo());
			die();
		}

		$rows=$stmt->fetchAll();
		foreach ($rows as $riga) {
            echo "<tr>";
            echo "<td>".$riga["tipoVino"]."</td>";
			echo "<td>".$riga["nomeVino"]."</td>";
			echo "<td>".$riga["nome"]."</td>";
			echo "<td>".$riga["Provincia"]."</td>";
			echo "</tr>";
		}
	} 

	catch (Exception $e) {
		echo "Errore nella l'esecuzione della query"
		
	}



	?>
	</tbody>
    </table>

</body>
</html>