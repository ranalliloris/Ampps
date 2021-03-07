<?php
    try
    {
        $db=new PDO('mysql:host=localhost; dbname=phone','lorisranalli','lorisranallo');
        echo 'Connessione stabilita';
    }
    catch(PDOException $e)
    {
        echo 'Connessione non riuscita\n'.$e;
        die();
    }
    
?>