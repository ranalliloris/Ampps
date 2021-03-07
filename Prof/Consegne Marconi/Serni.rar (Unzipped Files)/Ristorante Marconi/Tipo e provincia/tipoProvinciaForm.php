<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca vino per tipo e annata</title>
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
label{color: black;
  background-color:gold;
  font-family: timesnewroman;
  font-size: 300%;
  border-style:groove ;
}
</style>
</head>
<body>
    <h1>Ricerca per tipo e provincia</h1>
    <form action="tipoProvincia.php" method="POST">
        <label>Tipo vino</label>
        <select name="tipo">
            <option value="Rosso">Rosso</option>
            <option value="Bianco">Bianco</option>
        </select>
        <br><br>
        
        <label>Provincia: </label>
        <select name="sigla">
        <?php
                try{
                    $db=new PDO("mysql:host=localhost; dbname=ristorantemarconi", "aldobaglio", "guido");
                    echo "Connessione stabilita";
                }catch(PDOException $e){
                    echo "Errore: ".$e->getMessage();
                    die();
                }

                try
                {
                   $query= 'SELECT sigla
                            FROM province';
                    $stmt=$db->prepare($query);
                    if(!$stmt->execute())
                    {
                        echo "Errore nell'esecuzione della query: ";
                        print_r($stmt->errorInfo());
                        die();
                    }

                    $rows=$stmt->fetchAll();
                    foreach($rows as $riga)
                    {
                        echo '<option value="'.$riga["sigla"].'">'.
                        $riga["sigla"].'</option>';
                    }
                }catch(PDOException $e)
                {
                    echo "Errore: ".$e;
                }
            ?>
        </select>
        <br><br>

        <input type="submit" value="Cerca">
    </form>
</body>
</html>