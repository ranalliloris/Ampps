<!DOCTYPE html>
<html>
<head>
	<title>Risultato della ricerca</title>
</head>
<body>
	<h1>
		<?php
			if ($_POST["tipo"]=="Rosso") {
				$tipo="rossi";
			}
			else{
				$tipo="bianchi";
			}
			echo "Lista dei Vini ".$_POST["tipo"]." della provincia ".$_POST["provincia"];
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

	<?php


	try{
            $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "faur", "rumenaccio");
            echo "Connessione stabilita";

        }catch(PDOException $e){
            echo "Errore: ".$e->getMessage();
            die();
        }

        try {
		$query="SELECT V.nomeVino, C.nome, P.provincia
		FROM vino as V INNER JOIN cantina as C on V.idCantina=C.id
            INNER JOIN provincia as P on P.sigla=C.provincia
		WHERE P.provincia='Arezzo' AND tipoVino='Rosso'";
		$stmt=$db->prepare($query);

		$stmt=$db->bindParam(":tipo,$P_POST["tipo"]");
		$stmt->bindParam(":provincia,$P_POST["provincia"]");
		if (!$stmt->execute()) {
			echo "Errore nell' esecuzione: ";
			print_r($stmt->errorInfo());
			die();
		}

		$rows=$stmt->fetchAll();
		foreach ($rows as $riga) {
			echo "<tr>";
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