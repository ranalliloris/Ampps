<?php
    try
    {
        $db=new PDO('mysql:host=localhost; dbname=ristorantemarconi','user','user');
        echo 'Connessione stabilita';
    }
    catch(PDOException $e)
    {
        echo 'Connessione non riuscita\n'.$e;
        die();
    }
    
?>