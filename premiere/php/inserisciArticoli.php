<?php
require_once __DIR__."/include/connectionDB.php";

$dbConn=new dbConnect("localhost","userdb","userdb","premiere");

if($dbConn->connect())
{
    echo "Connessione stabilita correttamente";
}
else
{
    echo "Connessione non stabilita";
}

$values=[
            ":NumArt"=>$_POST["NumArt"],
            ":Descrizione"=>$_POST["Descrizione"],
            ":Giacenza"=>$_POST["Giacenza"],
            ":Categoria"=>$_POST["Categoria"],
            ":Magazzino"=>$_POST["Magazzino"],
            ":PrzUnitario"=>$_POST["PrzUnitario"]
        ];

$dbConn->insert("articoli",$values);

?>










