<!DOCTYPE html>
<html>
<head>
	<title>Risultato della ricerca</title>
</head>
<body>

	<table border="1">
		<thead>
			<tr>
				<th>tipoVino</th>
				<th>Nome del Vino</th>
				<th>Cantina</th>
				<th>Provincia</th>
			</tr>
		</thead>
		<tbody>

	<?php


	try{
            $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "guido", "abcd");
            echo "Connessione stabilita";

        }catch(PDOException $e){
            echo "Errore: ".$e->getMessage();
            die();
        }

        try {
		$query="SELECT v.nomeVino ,v.nomeVino, v.nome, c.provincia
		FROM vino as v 
		INNER JOIN cantina as c on v.idCantina=c.id
		INNER JOIN provincie as p on p.sigla=c.provincia
		WHERE p.regione='Piemonte'";
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