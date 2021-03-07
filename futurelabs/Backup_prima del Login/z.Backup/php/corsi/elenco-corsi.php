<?php
    session_start();
    require_once (__DIR__.'/../../inc/info_glob.inc.php');
    include_once (__DIR__.'/../function/funDate.php');
    include_once __DIR__.'/../../classi/connectionDB.php';
    include_once __DIR__.'/../../classi/function.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
    
    try
    {
        $stmt=elencoCorsi($dbconn); //Restituisce tabella con cod_corso, nome, max partecipanti, numero iscritti
        $rows=$stmt->fetchAll();
        foreach($rows as $row)
        {
            $disabled="";
            $full='';
            if($row["iscrizioni"]>=$row["max_partecipanti"])
            {
                $disabled="disabled";
                $full='<span class="req"> !!! PIENO - Non sono possibili ulteriori iscrizioni</span>';
            }
                
            $dati["html"].=' <div class="form-check">
                                <input class="form-check-input corsi-fl" type="checkbox" name="corsiFlSel[]" value="'.$row["cod_corso"].'" id="'.$row["cod_corso"].'" '.$disabled.'>
                                <label class="form-check-label" for="'.$row["cod_corso"].'">'.
                                    $row["nome"].' '.$full
                                .'</label>
                            </div>';
            
        }
        $dati["esito"]="success";
        echo json_encode($dati);
    }
    catch(Exception $e)
    {
            $dati["esito"]="err_exc";
            $dati["html"]=$e->getMessage();
            echo json_encode($dati);
    }
?>