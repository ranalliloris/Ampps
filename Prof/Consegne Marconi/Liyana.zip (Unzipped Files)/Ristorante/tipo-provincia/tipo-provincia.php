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
            if($_POST["tipo"]=="Rosso")
            {
                $tipo="rossi";
            }
            else
            {
                $tipo="bianchi";
            }
            echo "Lista dei vini ".$tipo." della provincia di ".$_POST["provincia"];
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
                    $query="SELECT v.nomeVino, c.nome, c.provincia
                            FROM vino v, cantina c, province p
                            WHERE v.idCantina=c.id AND
                                  c.provincia=p.sigla AND
                                  tipoVino=:tipo AND
                                  p.provincia=:provincia                                  
                            ";
                    $stmt=$db->prepare($query);
                    
                    $stmt->bindParam(":tipo",$_POST["tipo"]);
                    $stmt->bindParam(":provincia",$_POST["provincia"]);
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