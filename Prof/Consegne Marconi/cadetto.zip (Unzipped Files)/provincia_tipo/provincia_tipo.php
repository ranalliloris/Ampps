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
                <th>Cantina</th>
                <th>Provincia</th>
            </tr> 
        </thead> 
                <tbody> 
                        <?php
                        if($_POST["tipo"]=="Rosso")
                        {
                            $tipo="rossi";
                        }
                        else
                        {
                            $tipo="bianchi";
                        }
                            echo "Lista dei vini ".$tipo." della provincia ".$_POST["provincia"];
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
                            $query="SELECT nomeVino, nome, P.provincia
                                    FROM Vino AS V INNER JOIN Cantina AS C
                                        ON V.idCantina = C.id INNER JOIN Province AS P
                                        ON P.sigla = C.provincia
                                    WHERE tipoVino=:tipo AND P.provincia= :provincia";

                            $stmt=$db->prepare($query);
                            $stmt->bindParam(":tipo",$_POST["tipo"]);
                            $stmt->bindParam(":provincia",$_POST["provincia"]);

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