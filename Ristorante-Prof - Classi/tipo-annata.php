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
            echo ("Lista Vini ".(($_GET["tipo"]=="rosso")?"Rossi":"Bianchi")." ".$_GET["annata"]);
        ?>
    </h1>
    <table border='1'>
        <thead>
            <tr>
                <th>Nome Vino</th>
                <th>Nome Cantina</th>
                <th>Provincia</th>
        </thead>
        <tbody>
    <?php
        include __DIR__.'/classi/connectionDB.php';
        $dbconn=new dbConnect('localhost','lorisranalli','lorisranalli','ristorantemarconi');
        $dbconn->connect();
        try
        {
            
            $query="SELECT nomeVino, nome, provincia
                    FROM vino INNER JOIN cantina 
                        ON vino.idCantina=cantina.id
                    WHERE tipoVino=:tipo AND annata=:annata";
            $parameters=[
                            ":tipo"=>$_GET["tipo"],
                            ":annata"=>$_GET["annata"] 
                        ];
            $rows=$dbconn->query($query,$parameters);
            if($rows==null)
            {
                echo "<tr>
                        <td colspan='3'>Nessun vino trovato
                        </td>
                        </tr>";
                die();
            }
            foreach($rows as $row)
            {
                echo "<tr>\n";
                echo "<td>".$row["nomeVino"]."</td>\n";
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