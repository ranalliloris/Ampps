<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assegnazione fornitura</title>
</head>
<body>
    <form action="./inserimentoFORNISCE.php" method="POST">

    <label> Al fornitore </label>
        <select name="pivaFornitoreF">
            <?php
            try{
                $db=new PDO("mysql:host=localhost; dbname=cadettocservice", "userdb", "userdb");
                echo "Connessione stabilita";
            }catch(PDOException $e){
                echo "Errore: ".$e->getMessage();
                die();
            }
            try
            {
               $query= 'SELECT P_IVA, nome
                        FROM fornitore';
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
                    echo '<option value="'.$riga["P_IVA"].'">
                    '.$riga["P_IVA"].'
                    '." - ".'
                    '.$riga["nome"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
              
        <label> richiedi la fornitura </label>
        <select name="idFornituraF" >
            <?php
            try{
                $db=new PDO("mysql:host=localhost; dbname=cadettocservice", "userdb", "userdb");
                echo "Connessione stabilita";
            }catch(PDOException $e){
                echo "Errore: ".$e->getMessage();
                die();
            }
            try
            {
               $query= 'SELECT ID, nome
                        FROM fornitura';
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
                    echo '<option value="'.$riga["ID"].'">
                    '." ID: ".'
                    '.$riga["ID"].'
                    '." - Nome: ".'
                    '.$riga["nome"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
        <br><br>

        <label> Entro la data </label>
        <input type="date" name="data" required />
        <br><br>

        <label> in quantità </label>
        <input type="number" name="quantita" required min="1"/>
        <br><br>

        <input type="submit" value="INVIA" />
        <input type="reset" value="RESETTA" />
    </form>
</body>
</html>