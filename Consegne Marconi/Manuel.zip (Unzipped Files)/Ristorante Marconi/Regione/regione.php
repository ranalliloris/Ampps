<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato della ricerca</title>
    <link href="../CSS/Style.css" rel="stylesheet">
</head>
<body>
    <h1>risultato della ricerca</h1>
    <h1>

    <table>
        <thead>
            <tr>
                <th>Nome del vino</th>
                <th>Tipo del vino</th>
                <th>Cantina</th>
                <th>Provincia</th>
            </tr> 
        </thead> 
                <tbody> 
    </h1>

                    <?php
                        try{
                            $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "christian", "christian");
                            /*echo "Connessione stabilita";*/
                        }catch(PDOException $e){
                            echo "Errore: ".$e->getMessage();
                            die();
                        }

                        try{
                            $query="SELECT vino.nomeVino, vino.tipoVino, cantina.nome, cantina.provincia
                                    FROM vino INNER JOIN cantina 
                                        ON vino.idCantina = cantina.id
                                        INNER JOIN province
                                        ON cantina.provincia = province.sigla
                                    WHERE regione=:regione";
                            $stmt=$db->prepare($query);
                            $stmt->bindParam(":regione",$_POST["regione"]);

                            if(!$stmt->execute()){
                                echo "Errore nell'esecuzione della query: ";
                                print_r($stmt->errorInfo());
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
                        catch(PDOException $e)
                        {
                            echo "Errore nell'esecuzione della query: ".$e->getMessage();
                        }
                    ?>
        </tbody>
    </table>
</body>
</html>