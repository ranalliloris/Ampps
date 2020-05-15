<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato Ricerca Annata-Tipo</title>
</head>
<body  background="\DB Ristorante Marconi - Manzillo 5B Info\sfondo vino.jpg">
    <h1 style="font-family: cursive;text-align: center;">
       <?php
            if ($_POST["tipoVino"] == "Rosso")
            {
                $tipo = "rossi";
            }
            else
            {
                $tipo = "bianchi";
            }
            echo "Lista dei Vini " . $tipo . " dell'annata " .$_POST["annata"].":";
       ?>
    </h1>
    <table border="1">
        <thread>
            <tr>
                <h2>
                    <th style="font-family: cursive;text-align: center;">Nome del Vino<th>
                    <th style="font-family: cursive;text-align: center;">Cantina</th>
                    <th style="font-family: cursive;text-align: center;">Provincia</th>
                </h2>
            </tr>
        </tread>
        <tbody>
            <?php 
                   try
                   {
                       $db = new PDO("mysql:host=localhost;dbname=RistoranteMarconi","userdb","userdb");
                       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   }
                   catch(PDOException $e)
                   {
                       echo 'Connessione non riuscita\n'.$e;
                       die();
                   }
                    try
                    {
                        $query ="SELECT v.nomeVino,c.nome,
                        c.provincia
                        FROM VINO AS v JOIN CANTINA  AS c
                        ON v.idcantina = c.id 
                        WHERE tipoVino=:tipoVino AND annata=:annata";

                        $stmt = $db->prepare($query);
                        $stmt->bindParam(":tipoVino",$_POST["tipoVino"]);
                        $stmt->bindParam(":annata",$_POST["annata"]);

                        if(!$stmt)
                        {
                            echo "Errore nell'esecuzione della query : ";
                            print_r($stmt->errorInfo());
                            die();
                        }
                        $rows=$stmt->fetchAll();
                        foreach($rows as $riga)
                        {
                            echo" <tr> ";
                            echo" <td>" .$riga["nomeVino"]."</td>";
                            echo" <td>" .$riga["nome"]."</td>";
                            echo" <td>" .$riga["provincia"]."</td>";
                            echo" </tr> ";
                        }
                    }
                    catch(Exception $e)
                    {
                        echo "Errore nell'esecuzione della query" .$e;
                        die();
                    }
            ?>
    </tbody>
    </table>
</body>
</html>