<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Risultato vini per tipo e provincia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
   <div align="center">

        <h1>Risultato Vini</h1>
       
        <table border="1">
            <tbody>

                <?php
                    try {
                        $db = new PDO('mysql:host=localhost; dbname=RistoranteMarconi', 'andrea', '5binfo');

                    } catch (PDOException $e) {
                        echo "Errore connessione DB: ".$e;
                        die();
                    }

                    try{
                        
                        $query = 
                                "SELECT v.nomeVino AS Nome, c.nome AS Cantina, v.annata AS Annata
                                 FROM VINO AS v
                                           JOIN CANTINA AS c ON v.idCantina = c.id
                                           JOIN PROVINCE AS p ON c.provincia = p.sigla
                                 WHERE v.tipoVino =:tipo AND c.provincia =:provincia;";

                        $statement = $db ->prepare($query);

                        $statement->bindParam(tipo, $_POST["Tipo"]);
                        $statement->bindParam(provincia, $_POST["Provincia"]);

                        if(!$statement->execute()){
                            echo "Errore: ";
                            print_r($statement->errorInfo());
                            die();
                        }
                        
                        if(!$statement->rowCount() > 0){
                            echo "Nessun vino corrispondente alla ricerca";
                        }else{
                            echo 
                                "<thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Cantina</th>
                                        <th>Annata</th>
                                    </tr>
                                </thead>";

                            $queryResult = $statement->fetchAll();
                    
                            foreach($queryResult as $raw){
                                echo "<tr>";
                                echo "<td>".$raw["Nome"]."</td>";
                                echo "<td>".$raw["Cantina"]."</td>";
                                echo "<td>".$raw["Annata"]."</td>";
                                echo "</tr>";

                            }
                    }

                    }catch(PDOException $e){
                        echo "Errore nell'esecuzione della query: ".$e->getMessage()
                        .$e->getLine().$e->getFile();
                    }

                ?>
            
            </tbody>
        <table>
    </div>
</body>
</html>