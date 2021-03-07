<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato ricerca tipo e annata</title>
	<style>
h1{color: black;
  background-color:gold;
  font-family: verdana;
  font-size: 300%;
  border-style:groove ;
}
body {text-align: center;
background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTZNMVTmqYw9LykauwVxedIN35tc-Ke1_oVdk321tyc5krTkKzN&usqp=CAU');
}
input{color: black;
  background-color:gold;
  font-family: timesnewroman;
  font-size: 300%;
  border-style:groove ;
}
label{color: black;
  background-color:gold;
  font-family: timesnewroman;
  font-size: 300%;
  border-style:groove ;
}
select{color: black;
  background-color:gold;
  font-family: timesnewroman;
  font-size: 300%;
  border-style:groove ;
}
table{color: black;
  background-color:gold;
  font-family: timesnewroman;
  font-size: 300%;
  border-style:groove ;

}

</style>
</head>
<body>
    <h1>

    <table>
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
                            echo "Lista dei vini ".$tipo." dell'annata ".$_POST["annata"];
                        ?>
    </h1>

                    <?php
                        try{
                            $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "aldobaglio", "guido");
                            /*echo "Connessione stabilita";*/
                        }catch(PDOException $e){
                            echo "Errore: ".$e->getMessage();
                            die();
                        }

                        try{
                            $query="SELECT nomeVino, nome, provincia
                                    FROM vino INNER JOIN cantina 
                                        ON vino.idCantina = cantina.id
                                    WHERE tipoVino=:tipo AND annata= :annata";
                            $stmt=$db->prepare($query);
                            $stmt->bindParam(":tipo",$_POST["tipo"]);
                            $stmt->bindParam(":annata",$_POST["annata"]);

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