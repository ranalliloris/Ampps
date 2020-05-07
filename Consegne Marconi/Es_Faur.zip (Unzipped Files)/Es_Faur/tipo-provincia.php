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
            $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "Faur", "lorisranalli");
            echo "Connessione stabilita";

        }catch(PDOException $e){
            echo "Errore: ".$e->getMessage();
            die();
        }

        try {
        $query="SELECT v.nomeVino, c.nome, c.provincia
            FROM vino AS v
            INNER JOIN cantina AS c ON v.idCantina=c.id
            INNER JOIN province AS p ON p.sigla= c.provincia
            WHERE p.provincia='Arezzo' AND tipoVino='rosso' 
            ";
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