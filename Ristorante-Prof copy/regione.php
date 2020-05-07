<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato Ricerca</title>
</head>
<body>
    <h1>
        <?php
            echo ("Lista Vini della Regione ".$_GET["regione"]);
        ?>
    </h1>
    <table border='1'>
        <thead>
            <tr>
                <th>Nome Vino</th>
                <th>Tipo Vino</th>
                <th>Nome Cantina</th>
                <th>Provincia</th>
        </thead>
        <tbody>
    <?php
        
        include __DIR__.'/classi/dbConnect.php';
        $dbConn=new dbConnect('localhost','ristorantemarconi','userdb','userdb');
        $db=$dbConn->connect();

        /*try
        {
            $db=new PDO('mysql:host=localhost; dbname=ristorantemarconi','lorisranalli','lorisranalli');
        }
        catch(Exception $e)
        {
            echo "Connessione al DB non riuscita: ".$e;
            die();
        }
        */
        try
        {
            
            /*$query="SELECT nomeVino, tipoVino, nome, cantina.provincia
                    FROM vino INNER JOIN cantina 
                        ON vino.idCantina=cantina.id 
                        INNER JOIN province
                        ON cantina.provincia=province.sigla
                    WHERE regione=:regione";
            $stmt=$db->prepare($query);
            $stmt->bindParam(":regione",$_GET["regione"]);
            if(!$stmt->execute())
            {
                echo "Errore nell'esecuzione della query: ";
                print_r($stmt->errorInfo());
            }
            $rows=$stmt->fetchAll();*/

            $query="SELECT nomeVino, tipoVino, nome, cantina.provincia
                    FROM vino INNER JOIN cantina 
                        ON vino.idCantina=cantina.id 
                        INNER JOIN province
                        ON cantina.provincia=province.sigla
                    WHERE regione=:regione";

            //$stmt->bindParam(":regione",$_GET["regione"]);
            $parameters= [ ":regione" => $_GET["regione"] ];
            $stmt=$dbConn->query($query,$parameters);
            $rows=$stmt->fetchAll();
            
            if($rows==null)
            {
                echo "<tr>
                        <td colspan='4'>Nessun vino trovato
                        </td>
                        </tr>";
                die();
            }
            foreach($rows as $row)
            {
                echo "<tr>\n";
                echo "<td>".$row["nomeVino"]."</td>\n";
                echo "<td>".$row["tipoVino"]."</td>\n";
                echo "<td>".$row["nome"]."</td>\n";
                echo "<td>".$row["provincia"]."</td>\n";
                echo "</tr>";
            }
        }
        catch(Exceptio $e)
        {
            echo "Errore nell'esecuzione della query: ".$e;
            die();
        }

    ?>
    </tbody>
</body>
</html>