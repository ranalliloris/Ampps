<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Risultato della ricerca</title>
  </head>
  <body>
    <h1>
      <?php
      if ($_POST["tipo"]=="Rosso") {
        $tipo="rossi";
      } else {
        $tipo="bianchi";
      }
      echo "Lista dei vini ".$tipo." dell'annata ".$_POST["annata"];
       ?>
    </h1>
    <table border="1">
      <thead>
        <tr>
          <th>Nome del vino</th>
          <th>Cantina</th>
          <th>Provincia</th>
        </tr>
      </thead>
      <tbody>
    <?php
    try{
          $db=new PDO("mysql:host=localhost; dbname=RistoranteMarconi", "patpat", "patpat2690");
          //echo "Connessione stabilita";
      }catch(PDOException $e){
          echo "Errore nella connessione al DB: ".$e;
      }

      try {
        //selezionare nome vino, nome cantina e sigla provincia di tutti i vini
        $query="
        SELECT v.nomeVino, c.nome, c.provincia
        FROM vino AS v INNER JOIN cantina AS c ON v.idCantina=c.id
        WHERE tipoVino=:tipo AND annata=:annata
        ";//:segnaposto

        $stmt=$db->prepare($query);
        $stmt->bindParam(":tipo",$_POST["tipo"]);
        $stmt->bindParam(":annata",$_POST["annata"]);

        if (!$stmt->execute()) {
          echo "Errore nell'esecuzione della query: ";
          print_r($stmt->errorInfo());
          die();
        }

        $rows=$stmt->fetchAll();
        foreach ($rows as $riga) {//as destinazione
          echo "<tr>";
          echo "<td>".$riga["nomeVino"]."</td>";
          echo "<td>".$riga["nome"]."</td>";
          echo "<td>".$riga["provincia"]."</td>";
          echo "</tr>";
        }

      } catch (\Exception $e) {
        echo "Errore durante l'esecuzione della query: ".$e;
        die();
      }

     ?>
   </tbody>
 </table>
  </body>
</html>
