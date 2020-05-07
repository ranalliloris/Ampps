<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato della ricerca</title>
</head>
<body>
    <center>
    <h1>
        <?php 
        if($_POST["tipo"]=="Rosso") {
            $tipo="rossi";
        }
        else {
            $tipo="bianchi";
        }
        echo "Lista dei vini ".$tipo." dell'anno ".$_POST["annata"];
        ?>
    </h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nome del vino </th>
                <th>Cantina </th>
                <th>Provincia </th>
            </tr>
        </thead>
        <tbody>
    <?php
    try {
        $db= new PDO("mysql:host=localhost; dbname=RistoranteMarconi", 'elii', 'fragole');
        echo "Connessione stabilita ";
    }
    catch(PDOException $e) {
        echo 'Connessione non riuscita, errore: '.$e->getMessage();
        die();
    }
    try {
        $query=" SELECT v.nomeVino, c.nome, c.provincia
                 FROM vino as v
                  INNER JOIN cantina as c 
                  ON v.idCantina=c.id
                WHERE tipoVino=:tipo AND annata=:annata
        "; // : SEGNAPOSTO

        $stmt=$db->prepare($query);
        $stmt->bindParam(":tipo",$_POST["tipo"]);
        $stmt->bindParam(":annata",$_POST["annata"]);
        
        if(!$stmt->execute()) {
            echo "Errore nell'exe della query: ";
            print_r($stmt->errorInfo());
            die();
        }

        $rows=$stmt->fetchAll();
        foreach($rows as $riga) {
            echo "<tr>";
            echo "<td>".$riga["nomeVino"]."</td>";
            echo "<td>".$riga["nome"]."</td>";
            echo "<td>".$riga["provincia"]."</td>";
            echo "</tr>";
        }
    }
    catch(Exception $e) {
        echo "Errore durante l'esecuzione della query: " .$e;
        die();
    }
    ?>
        </tbody>
    </table>
    </center>
    <style>
    footer 
    {
    text-align: right;
    position: absolute;
    bottom: 0;
    }
</style>
<footer>
    Torna alla <a href="homepage.html">homepage</a> 
    <br><br>
</footer>
</body>
</html>