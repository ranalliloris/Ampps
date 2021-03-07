<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ricerca vino per tipo e provincia</title>
</head>
<body background="https://img2.tgcom24.mediaset.it/binary/fotogallery/dal-web/73.$plit/C_2_fotogallery_3004647_0_image.jpg" style="background-size:cover;">
        <div align="center">
            <br> <br>
        <h1>Ricerca Vino per tipo e provincia</h1>
        <br> <br> <br> <br>
        <form action="ViewTipoProvincia.php" method="POST" >
         
        <div class="input-group mb-2" style="width: 10%;">
                <label class="input-group-text" for="inputGroupSelect01">tipo Vino</label>
                <select name ="tipo" class=" custom-select-lg"  id="inputGroupSelect01">
                    <option value="Rosso">Rosso</option>
                    <option value="Bianco">Bianco</option>
                </select>
        </div>
        <div class=>
        <div class="input-group mb-2 " style="width: 18%;">
        <div class="input-group-prepend" >
            <label  class="input-group-text"for="inputGroupSelect01">provincia<label> 
            </div>
            <select name="provincia" class="custom-select-lg" id="inputGroupSelect01" >
        
      
            <?php
                try{
                    $db = new PDO("mysql:host=localhost;dbname=RistoranteMarconi","userdb","userdb");
                }catch(PDOexeption $e){
                    echo "Errore: ".$e->getMessage();
                    die();
                }
                try{

                    $query ="SELECT provincia, regione 
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
                    echo  '<option value ="'.$riga["provincia"].'">
                            '.$riga["regione"].',
                            '.$riga["provincia"].'
                            </option>';
                }
                }catch(PDOException $e)
                {
                    echo "Errore: ".$e;
                }

            ?>
        </select>
            </div>
            
            <button  type="submit" formaction="../index.html" class="btn btn-outline-secondary" >Home page</button> 
        <input type="submit" value= "Cerca" class="btn btn-outline-secondary" >
        
        </form>
    </div>
</body>
</html>