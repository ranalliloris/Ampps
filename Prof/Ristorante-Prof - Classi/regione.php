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
        include __DIR__.'/classi/connectionDB.php';
        $dbconn=new dbConnect('localhost','lorisranalli','lorisranalli','ristorantemarconi');
        $dbconn->connect();
        try
        {
           /* $condition=[
                            ':id'=> '1',
                            ':nomeVino' => 'Brunello di Montalcino'
                        ];
            $dbconn->delete('vino',$condition);
            */ //CON QUESTO DA ERRORE
            
            $query="SELECT nomeVino, tipoVino, nome, cantina.provincia
                    FROM vino INNER JOIN cantina 
                        ON vino.idCantina=cantina.id 
                        INNER JOIN province
                        ON cantina.provincia=province.sigla
                    WHERE regione=:regione";
            $parameters =[':regione' => $_GET['regione']];        
            
            $stmt=$dbconn->query($query,$parameters);
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