<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Risultato della ricerca</title>
    </head>
    <body class="bg-light" background="https://static.winenews.it/2019/11/BottglieperOpera.jpg" style="background-size:100%">
        <br><br>
        <h1 align = "center" class="text-light"><?php 
                if($_POST["tipo"]=="Rosso"){
                    $tipo = "rossi";
                }else
                {
                    $tipo ="bianchi";
                }
                echo "Vini ".$tipo." dell'annata ".$_POST["annata"];
        
            ?>
        </h1>
        <br> <br> <br>
        <table  align = "center" class="table table-hover table-bordered bg-light" style="width: 50%;">
            <thead>
                <tr>
                    <h1>
                        <th>Nome del Vino </th>
                        <th> Cantina </th>
                        <th> Provincia </th>
                    </h1>
                </tr>

            </thead>
            <tbody>
                <?php
                try{
                    $db = new PDO("mysql:host=localhost;dbname=RistoranteMarconi","userdb","userdb");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    echo "Errore: ".$e->getMessage();
                    die();
                }
                try{

                    $query ="SELECT v.nomeVino, c.nome, c.provincia 
                            FROM vino as v, cantina as c
                            WHERE v.idCantina= c.id
                            AND annata=:annata
                            AND tipoVino =:tipo";
                    $stnt = $db -> prepare($query);
                    $stnt -> bindParam(":tipo", $_POST["tipo"]);
                    $stnt -> bindParam(":annata", $_POST["annata"]);
                    if(!$stnt-> execute()){
                        echo "ERRORE nell'esecuzione della query ";
                        print_r($stnt->errorInfo());
                        die();
                    }
                    $rows = $stnt->fetchAll();
                    foreach($rows as $riga){
                        echo"<tr>
                                <td>".$riga["nomeVino"]."</td>
                                <td>".$riga["nome"]."</td>
                                <td>".$riga["provincia"]."</td>
                            </tr>";


                    }
                }
                catch(Exception $e){}
                ?>
            </tbody>
        </table>
    <form action="../index.html" align="center">
        <button type="submit" class="btn btn-outline-light" >Home page</button> 
    </form>
    </body>
</html>