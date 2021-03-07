<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ricerca vino per regione </title>
</head>
<body class="bg-light" background="https://www.genteditalia.org/wp-content/uploads/2019/05/Depositphotos_13347611_s-2019.jpg" style="background-size:cover">
    <div align = "center">
    <br><br>
        <h1>Ricerca vino per regione</h1>
        <br><br><br><br><br>
        <form action="ViewRegione.php" method="POST">
        <div class="input-group mb-3" style="width:15%">
            <div class="input-group-prepend" >
            <label  class="input-group-text"for="inputGroupSelect01">regione<label> 
            </div>
            <select name="regione" class="custom-select-lg" id="inputGroupSelect01" >
                <?php
                    try{
                        $db = new PDO("mysql:host=localhost;dbname=RistoranteMarconi","userdb","userdb");
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }catch(PDOException $e){
                        echo "Errore: ".$e->getMessage();
                        die();
                    }
                    try{

                        $query ="SELECT regione 
                                FROM PROVINCE
                                ";
                        $stnt = $db -> prepare($query);
                        if(!$stnt-> execute()){
                            echo "ERRORE nell'esecuzione della query ";
                            print_r($stnt->errorInfo());
                            die();
                        }
                    $rows = $stnt->fetchAll();
                    foreach($rows as $riga){
                        echo  '<option value ="'.$riga["regione"].'">
                                '.$riga["regione"].'
                                </option>';
                    }
                    }catch(PDOException $e)
                    {
                        echo "Errore: ".$e;
                    }
                ?>
            </select>
            </div>
               
            <button  type="submit" formaction="../index.html" class="btn btn-light" >Home page</button>  
             <input type = "submit" value="cerca" class="btn btn-light">
            
           
        </form>

        
    </div>
</body>
</html>