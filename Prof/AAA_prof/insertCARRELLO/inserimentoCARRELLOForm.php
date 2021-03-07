<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARRELLO</title>
</head>
<body>
    <form action="./inserimentoCARRELLO.php" method="POST">

    <label> Acquista il prodotto </label>
        <select name="idProdottoC">
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
               $query= 'SELECT ID, prezzoVendita, nome, tipo
                        FROM prodotto';
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
                    '.$riga["ID"].'
                    '." - Costo prodotto: ".'
                    '.$riga["prezzoVendita"].'
                    '."€ - Nome prodotto: ".'
                    '.$riga["nome"].'
                    '." - Tipo prodotto:  ".'
                    '.$riga["tipo"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
        <br><br>      
        <label> Username </label>
        <select name="usernameUtenteC" >
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
               $query= 'SELECT username, email, nome, cognome, p_iva
                        FROM utente';
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
                    echo '<option value="'.$riga["username"].'">
                    '." Username: ".'
                    '.$riga["CF"].'
                    '." - Email: ".'
                    '.$riga["email"].'
                    '." - Nome:  ".'
                    '.$riga["nome"].'
                    '." - Cognome: ".'
                    '.$riga["cognome"].'
                    '." - P.iva: ".'
                    '.$riga["p_iva"].'</option>';
                }                
            }catch(PDOException $e)
            {
                echo "Errore: ".$e;
            }
            ?>
        </select>
        <br><br>

        <label>Quantità</label>
        <input type="number" name="quantita" />
        <br><br>

        <input type="submit" value="INVIA" />
        <input type="reset" value="RESETTA" />
    </form>
</body>
</html>