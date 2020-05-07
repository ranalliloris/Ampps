<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato della ricerca</title>
</head>
<body>
    <h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nome del vino</th>
                <th>Tipo del vino</th>
                <th>Cantina</th>
                <th>Provincia</th>
            </tr> 
        </thead> 
                <tbody> 
                        <?php
                            echo "Lista dei vini della regione ".$_POST["regione"];
                        ?>
    </h1>

                    <?php
                        try{
                            $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "userdb", "userdb");
                            /*echo "Connessione stabilita";*/
                        }catch(PDOException $e){
                            echo "Errore: ".$e->getMessage();
                            die();
                        }

                        try{
                            $query="SELECT V.nomeVino, V.tipoVino, C.nome, P.provincia
                                    FROM Vino AS V INNER JOIN Cantina AS C
                                        ON V.idCantina = C.id INNER JOIN Province AS P
                                        ON C.provincia = P.sigla
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