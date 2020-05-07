<!DOCTYPE html>
<html>
<head>
	<title>Risultato della ricerca</title>
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

	<?php

	try{
            $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "Faur", "mysql");
            echo "Connessione stabilita";

        }catch(PDOException $e){
            echo "Errore: ".$e->getMessage();
            die();
        }

        try {
        $query="SELECT v.nomeVino, c.nome, c.provincia
            FROM vino AS v
                INNER JOIN Cantina AS c ON v.idCantina = c.id
                INNER JOIN Provincie AS p ON p.sigla = c.provincia
            WHERE p.regione ='Piemonte'";
		$stmt=$db->prepare($query);

		$stmt=$db->bindParam(":tipo,$P_POST["tipo"]");
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