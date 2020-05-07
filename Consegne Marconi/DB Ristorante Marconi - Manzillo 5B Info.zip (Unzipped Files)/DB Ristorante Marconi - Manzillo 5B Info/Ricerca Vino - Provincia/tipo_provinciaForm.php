<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Ricerca Vino per Tipo e Provincia</title>
</head>
<body background="\DB Ristorante Marconi - Manzillo 5B Info\sfondo vino.jpg">
    <h1 style="font-family: cursive;text-align: center;">Ricerca Vino per Tipo e Provincia</h1>
    <br><br>
    <form action='./tipo_provincia.php' method="POST"></form>
        <label style="text-align: center;font-weight: bold;">Tipo Vino: </label>
        <select name="tipoVino">
            <option value="Rosso">Rosso</option>
            <option value="Bianco">Bianco</option>
        </select>
        <br><br>
        <label style="text-align: center;font-weight: bold;""> Provincia (Sigla) : </label>
        <select name ="sigla" >
            <?php 
                try
                {
                    $db = new PDO("mysql:host=localhost;dbname=RistoranteMarconi"," mela","pollofritto9012");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(PDOException $e)
                {
                    echo "Connessione non riuscita";
                    die();
                }
                try
                {
                    $query = 'SELECT sigla,
                        FROM PROVINCE';
                    $pStat = $db->prepare($query);
                    
                    if(!$pStat->execute())
                    {
                        echo "Errore nell'esecuzione della query";
                        print_r($pStat->errorInfo());
                        die();
                    }
                    $rows -> $pStat -> fetchAll();
                    foreach($rows as $riga)
                    {
                        echo '<option value = "'.$riga["sigla"].'></option>';
                              
                    }
                }
                catch(PDOException $e)
                {
                    echo "Connessione non riuscita";
                    die();
                }
            ?>
        <input type="submit" value="Cerca">
    </form>
</body>
</html>