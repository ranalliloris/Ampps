<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Risultato vini per regione</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
   <div align="center">

        <h1>Risultato Vini</h1>
       
        <table border="1">
            <tbody>

                <?php
                   
                   include __DIR__.'/../classi/dbConnect.php';
                   $dbConn=new dbConnect('localhost', 'ristorantemarconi', 'userdb', 'userdb');
                   $db=$dbConn->connect();

                   /*try {
                        $db = new PDO('mysql:host=localhost; dbname=RistoranteMarconi', 'andrea', '5binfo');

                    } catch (PDOException $e) {
                        echo "Errore connessione DB: ".$e;
                        die();
                    } */

                    try{
                        
                        /* $query = 
                                "SELECT v.nomeVino AS Nome, c.nome AS Cantina, v.annata AS Annata, 
                                        v.tipoVino AS Tipo, p.provincia AS Provincia
                                 FROM PROVINCE AS p 
                                            JOIN CANTINA AS c ON p.sigla = c.provincia
                                            JOIN VINO AS v ON c.id = v.idCantina
                                 WHERE p.regione =:regione";

                        $statement=$db->prepare($query);

                        $statement->bindParam(regione, $_POST["Regione"]);

                        if(!$statement->execute()){
                            echo "Errore: ";
                            print_r($statement->errorInfo());
                            die();
                        } */
                        
                        $query = 
                                'SELECT v.nomeVino AS Nome, c.nome AS Cantina, v.annata AS Annata, 
                                        v.tipoVino AS Tipo, p.provincia AS Provincia
                                 FROM PROVINCE AS p 
                                            JOIN CANTINA AS c ON p.sigla = c.provincia
                                            JOIN VINO AS v ON c.id = v.idCantina
                                 WHERE p.regione =:regione';
                        
                        $parameters = ["regione"=>$_POST["regione"]] ;
                        $stmt = $dbConn->query($query, $parameters);

                        if(!$stmt->rowCount() > 0)
                        {
                            echo "Nessun vino corrispondente alla ricerca";
                        }
                        else{
                            echo 
                                "<thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Cantina</th>
                                        <th>Annata</th>
                                        <th>Tipo</th>
                                        <th>Provincia</th>
                                    </tr>
                                </thead>";

                            $queryResult = $stmt->fetchAll();
                    
                            foreach($queryResult as $raw)
                            {
                                echo "<tr>";
                                echo "<td>".$raw["Nome"]."</td>";
                                echo "<td>".$raw["Cantina"]."</td>";
                                echo "<td>".$raw["Annata"]."</td>";
                                echo "<td>".$raw["Tipo"]."</td>";
                                echo "<td>".$raw["Provincia"]."</td>";
                                echo "</tr>";

                            }
                    

                        } 
                        
                    }
                        catch(PDOException $e)
                        {
                        echo "Errore nell'esecuzione della query: ".$e->getMessage().$e->getLine().$e->getFile();
                        }

                ?>
            
            </tbody>
        <table>
    </div>
</body>
</html>