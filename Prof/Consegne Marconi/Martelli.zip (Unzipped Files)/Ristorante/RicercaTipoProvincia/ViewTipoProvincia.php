<!DOCTYPE html>
<html lang="it">
<head>
  1
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Risultati della ricerca</title>
</head>
<body class="bg-light" background="https://static.winenews.it/2019/11/BottglieperOpera.jpg" style="background-size:cover">
        <br> <br>
         <h1 align = "center" class="text-light"><?php 
                if($_POST["tipo"]=="Rosso"){
                    $tipo = "rossi";
                }else
                {
                    $tipo ="bianchi";
                }
                echo "Vini ".$tipo." prodotti in provincia di ".$_POST["provincia"];
        
            ?>
        </h1>
        <br> <br> <br>
    <table align ="center" class="table table-hover table-bordered bg-light" style="width: 50%;">
    <thead>
            <tr>
                <th>Nome del Vino </th>
                <th> Cantina </th>
            </tr>
        </thead>
         <!-- ho deciso di non stampare la provincia perché la hanno tutti uguale -->
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

                $query ="SELECT v.nomeVino, c.nome
                        FROM VINO as v, CANTINA as c, PROVINCE as p 
                        WHERE v.idCantina= c.id 
                        AND c.provincia = p.sigla
                        AND p.provincia = :provincia
                        AND v.tipoVino = :tipo";

                $stnt = $db -> prepare($query);
                $stnt -> bindParam(":provincia", $_POST["provincia"]);
                $stnt -> bindParam(":tipo", $_POST["tipo"]);
            
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
                        </tr>";
                }
            }catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }
                
            ?>
        
    </table>
    <form action="../index.html" align="center">
        <button type="submit" class="btn btn-outline-light" >Home page</button> 
    </form>
</body>
</html>