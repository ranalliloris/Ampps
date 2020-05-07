<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Risultato vini per tipo e annata</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Home_page.css" />
</head>
<body>
    <div  class="container-fluid">
        <h1 align="center"class="font-weight-light text-danger">Risultato Vini</h1>

        <div class="row">
            <div class="col">
                <div class="card mx-auto">
                    <div class="card-body">                  
                        <table border="1" class="table table-hover">
                            <tbody>
                                <?php
                                    try {
                                        $db = new PDO('mysql:host=localhost; dbname=RistoranteMarconi', 'userdb', 'userdb');

                                    } catch (PDOException $e) {
                                        echo "Errore connessione DB: ".$e;
                                        die();
                                    }

                                    try{
                                        
                                        $query = 
                                                "SELECT v.nomeVino AS Nome, c.nome AS Cantina, p.provincia AS Provincia
                                                FROM VINO AS v
                                                        JOIN CANTINA AS c ON v.idCantina = c.id
                                                        JOIN PROVINCE AS p ON c.provincia = p.sigla
                                                WHERE v.tipoVino =:tipo AND v.annata =:annata";

                                        $statement = $db ->prepare($query);

                                        $statement->bindParam(tipo, $_POST["Tipo"]);
                                        $statement->bindParam(annata, $_POST["Annata"]);

                                        if(!$statement->execute()){
                                            echo "Errore: ";
                                            print_r($statement->errorInfo());
                                            die();
                                        }
                                        
                                        if(!$statement->rowCount() > 0){
                                            echo "Nessun vino corrispondente alla ricerca";
                                        }else{
                                            echo 
                                                "<thead class='thead-dark'>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Cantina</th>
                                                        <th>Provincia</th>
                                                    </tr>
                                                </thead>";

                                            $queryResult = $statement->fetchAll();
                                    
                                            foreach($queryResult as $raw){
                                                echo "<tr>";
                                                echo "<td>".$raw["Nome"]."</td>";
                                                echo "<td>".$raw["Cantina"]."</td>";
                                                echo "<td>".$raw["Provincia"]."</td>";
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>