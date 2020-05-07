<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato della Ricerca</title>
</head>
<body>
    <h1>
        <?php
            echo "Lista dei vini di ".$_POST["regione"];
        ?>
    </h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nome del Vino</th>
                <th>Tipo di Vino</th>
                <th>Cantina</th>
                <th>Provincia</th>
            </tr>
        </thead>

        <tbody>
              
            <?php
                try
                {
                    $db=new PDO('mysql:host=localhost; dbname=ristorantemarconi','userdb','userdb');
                }
                catch(Exception $e)
                {
                    echo "Errore nella connessione al DB: ".$e;
                    die();
                }

                try
                {
                    $query="SELECT v.nomeVino, v.tipoVino, c.nome, c.provincia
                            FROM vino v, cantina c, province p
                            WHERE v.idCantina=c.id AND
                                  c.provincia=p.sigla AND
                                  p.regione=:regione
                            ";
                    $stmt=$db->prepare($query);
                    
                    $stmt->bindParam(":regione",$_POST["regione"]);
                    if(!$stmt->execute())
                    {
                        echo "Errore nell'esecuzione della query: ";
                        print_r($stmt ->errorInfo());
                        die();
                    }

                    $rows=$stmt->fetchAll();
                    foreach($rows as $riga)
                    {
                        echo "<tr>";
                        echo "<td>".$riga["nomeVino"]."</td>";
                        echo "<td>".$riga["tipoVino"]."</td>";
                        echo "<td>".$riga["nome"]."</td>";
                        echo "<td>".$riga["provincia"]."</td>";
                        echo "</tr>";
                    }

                }
                catch(Exception $e)
                {
                    echo "Errore durante l'esecuzione della query: ".$e;
                    die();
                }      
            ?>

        </tbody>
    </table>
</body>
</html>