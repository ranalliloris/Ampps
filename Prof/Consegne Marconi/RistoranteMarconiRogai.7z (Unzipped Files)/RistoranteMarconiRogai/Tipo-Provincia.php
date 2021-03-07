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
			echo "Lista dei Vini ".$_POST["tipo"]." della Provincia ".$_POST["Provincia"];
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
            $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "guido", "abcd");
            echo "Connessione stabilita";

        }catch(PDOException $e){
            echo "Errore: ".$e->getMessage();
            die();
        }

        try {
		$query="SELECT v.nomeVino, c.nome, p.provincia
		FROM vino as v
		INNER JOIN cantina as c on v.idCantina=c.id
		INNER JOIN provincia as p on p.sigla=c.provincia
		WHERE p.provincia='Agrigento'" and tipoVino='rosso';
		$stmt=$db->prepare($query);

		$stmt=$db->bindParam(":tipo,$P_POST["tipo"]");
		$stmt->bindParam(":Provincia,$P_POST["Provincia"]");
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
		echo "Errore nella l'esecuzione della query";
		
	}



	?>
	</tbody>
    </table>

</body>
</html>