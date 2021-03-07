<?php
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    include_once __DIR__.'/../classi/function.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $plesso=$_POST["plesso"];

    
    try
    {
        $stmt=elencoClassiPlesso($dbconn, $plesso);
        $rows=$stmt->fetchAll();
        if(count($rows)>0)
        {
            foreach($rows as $row)
            {
                echo '<option value="'.$row["codice"].'">'.$row["codice"].'</option>';
                   
            }
        }
        else
        {
            echo 'alert("Non sono state trovate classi per il plesso selezionato")</p>';
        }

    }

    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>