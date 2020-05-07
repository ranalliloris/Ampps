<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato Ricerca Regione</title>
</head>
<body  background="\DB Ristorante Marconi - Manzillo 5B Info\sfondo vino.jpg">
    <h1 style="font-family: cursive;text-align: center;">
       <?php
            echo "Lista Vini della Regione ".$_POST["regione"].;
       ?>
    </h1>
    <table border="1">
        <thread>
            <tr>
                <h2>
                    <th style="font-family: cursive;text-align: center;">Nome del Vino<th>
                    <th style="font-family: cursive;text-align: center;">Tipo di Vino <th>
                    <th style="font-family: cursive;text-align: center;">Cantina</th>
                    <th style="font-family: cursive;text-align: center;">Provincia </th>
                </h2>
            </tr>
        </tread>
        <tbody>
            <?php   
                    try
                   {
                       $db = new PDO("mysql:host=localhost;dbname= RistoranteMarconi"," mela","pollofritto9012");
                       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   }
                   catch(PDOException $e)
                   {
                       echo 'Connessione non riuscita\n'.$e;
                       die();
                   }
                    try
                    {
                        $query = "SELECT v.nomeVino,v.tipoVino,c.nome,
                        p.provincia
                        FROM VINO AS v JOIN CANTINA  AS c
                        ON v.idcantina = c.id JOIN PROVINCE AS p
                        ON c.provincia  = p.sigla
                        WHERE regione=:regione";

                        $stmt = $db->prepare($query);
                        $stmt->bindParam(":regione",$_POST["regione"]);

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
                            echo" <td>" .$riga["tipoVino"]."</td>";
                            echo" <td>" .$riga["nome"]."</td>";
                            echo" <td>" .$riga["sigla"]."</td>";
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