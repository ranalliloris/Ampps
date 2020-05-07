<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Risultati della ricerca</title>
    <br><br>
    <h1 align= "center" class="text-light"><?php 
                echo "Vini che sono stati prodotti in ".$_POST["regione"];
        ?>
    </h1>
</head>
<br> <br><br>
<body class="bg-light" background="https://static.winenews.it/2019/11/BottglieperOpera.jpg" style="background-size:cover">
    <table align = "center" class="table table-hover table-bordered bg-light" style="width: 50%;">
        <thead>
            <tr>
            <th>Nome del Vino </th>
            <th> Tipo Vino </th>
            <th> Cantina </th>
            <th> Provincia </th>
            </tr>
        </thead>
        <tbody>
            <?php
                try
                {
                $db = new PDO("mysql:host=localhost;dbname=RistoranteMarconi","userdb","userdb");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Errore: ".$e->getMessage();
                die();
            }
            try{

                $query ="SELECT v.nomeVino,v.tipoVino, c.nome, c.provincia
                        FROM VINO as v, CANTINA as c, PROVINCE as p 
                        WHERE v.idCantina= c.id 
                        AND c.provincia = p.sigla
                        AND p.regione=:regione";

                $stnt = $db -> prepare($query);
                $stnt -> bindParam(":regione", $_POST["regione"]);
            
                if(!$stnt-> execute()){
                    echo "ERRORE nell'esecuzione della query ";
                    print_r($stnt->errorInfo());
                    die();
                }
                $rows = $stnt->fetchAll();
                foreach($rows as $riga){
                    echo"<tr>
                            <td>".$riga["nomeVino"]."</td>
                            <td>".$riga["tipoVino"]."</td>
                            <td>".$riga["nome"]."</td>
                            <td>".$riga["provincia"]."</td>
                        </tr>";


                }
            }catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }
                
            ?>
        
        </tbody>
    </table>
    <form action="../index.html" align="center">
        <button type="submit" class="btn btn-outline-light" >Home page</button> 
    </form>
</body>
</html>