<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ricerca Vini per tipo e provincia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Home_page.css" />
    <script src='main.js'></script>
</head>
<body>
    <div class="container">
        <h1 align="center" class="font-weight-light text-danger">Ricerca vino per tipo e provincia</h1>

        <div class="row">
            <div class="col">
            
            </div>

            <div class="col">
                <div class="card card mx-auto">
                    <div class="card-body">                  
                        <form action="./Query_Tipo_Provincia.php" method="POST">
                            <label> Tipo: </label>
                            <br>
                            <select name="Tipo">
                                <option value="Rosso"> Vino Rosso </option>
                                <option value="Bianco"> Vino Bianco </option>
                            </select>   

                            <br><br>

                            <label> Provincia: </label>
                            <br>
                            <select name="Provincia">
                                <?php 
                                    try {
                                        $db = new PDO('mysql:host=localhost; dbname=RistoranteMarconi', 'DavideTarlini', 'diFzgWwDLJXZD3y2');
                                    } catch (PDOException $e) {
                                        echo "Errore connessione DB: ".$e;
                                        die();
                                    }

                                    $query = 'SELECT sigla, provincia, regione
                                            FROM PROVINCE';

                                    $statement = $db->prepare($query);
                                    if(!$statement->execute()){
                                        echo "Errore nell'esecuzione della query";
                                        print_r($statement->errorInfo());
                                        die();
                                    }

                                    $rows = $statement->fetchAll();
                                    foreach ($rows as $riga) {
                                        echo '<option value="'.$riga["sigla"].'">'.
                                            "Provincia: ".
                                            $riga["provincia"]."; ".
                                            "Regione: ".
                                            $riga["regione"].
                                            '</option>';
                                    }
                                ?>
                            </select>
                            
                            <br><br>
                            <input type="submit" value="Cerca" class="btn btn-lg btn-block btn-outline-primary"> 
                        </form>
                    </div>
                </div>
            </div>

            <div class="col">
            
            </div>
        </div>
    </div>
</body>
</html>







    