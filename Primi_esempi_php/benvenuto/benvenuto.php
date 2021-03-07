<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Risposta Benvenuto</title>
    
</head>
<body>
    
<?php
        $cognome=$_POST["cognome"];
        $nome=$_POST["nome"];
        echo "<h1>Benvenuto ".$cognome." ".$nome."</h1>";
        $arr=["Prova",5,"Nuti",3.5];
        echo $arr[2];
        $arrAss=["Ranalli"=>31, 
                 "Piemontese"=>94, 
                 "Nuti"=>"Emiliano"];
        echo $arrAss["Nuti"];
        echo "<p>Stampa Array Associativo con foreach</p>";
        echo '<table border="1">';
        foreach($arrAss as $persona)
        {
            echo "<tr><td>".$persona."</td></tr>";
        }
        echo "</table>";
        define("PIGRECO",3.14);

        echo PIGRECO;

        echo __DIR__;

        stampaNomeH1("Gioele Valentini");

        function stampaNomeH1($nome)
        {
            echo "<h1>".$nome."</h1>";
        }
    ?>
    <h1>PAGINI DI PROVA</h1>
    
</body>
</html>