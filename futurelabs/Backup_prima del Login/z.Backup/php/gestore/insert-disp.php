<?php
    session_start();
    require_once (__DIR__.'/../../inc/info_glob.inc.php');
    include_once (__DIR__.'/../function/funDate.php');
    include_once __DIR__.'/../../classi/connectionDB.php';
    include_once __DIR__.'/../../classi/function.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $data_disp=$_POST["data-disp"];

    try
    {
        
        if(!dataModificabile($data_disp))
        {
            $dati["esito"]="err_data";
            $dati["html"]='<p class="req"> Non si possono modificare le disponibilità di una data passata </p>';
            echo json_encode($dati);
            return;
        }
        $stmt=elencoProdotti($dbconn);
        $rows=$stmt->fetchAll();

        if(count($rows)>0)
        {
            if($_POST["insType"]=="update")
            {
                foreach($rows as $row)
                {
                    $idProd="".$row["id_prod"];
                    aggiornaDisponibilità($dbconn, $row["id_prod"], $data_disp, $_POST[$idProd]);
                }
            }
            else
            {
                foreach($rows as $row)
                {
                    $idProd="".$row["id_prod"];
                    insertDisponibilita($dbconn, $row["id_prod"], $data_disp, $_POST[$idProd]);
                }
            }
            $dati["esito"]="success";
            $dati["html"]='<p class="text-success">Salvataggio disponibilità avvenuto con Successo</p>';
        }
        else
        {
            $dati["esito"]="err";
            $dati["html"]='<p class="req">Errore nel salvataggio delle disponibilità</p>';
        }
        echo json_encode($dati);
    }

    catch(Exception $e)
    {
        $dati["html"]=$e->getMessage();
        echo json_encode($dati);
    }
?>