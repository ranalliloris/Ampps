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
        $row=$rows[0];
        foreach($rows as $row)
        {
            $disabled="";
            $full='';
            if($row["iscrizioni"]>=$row["max_partecipanti"])
            {
                $disabled="disabled";
                $full='<span class="req"> !!! PIENO - Non sono possibili ulteriori iscrizioni</span>';
            }
                
            $dati["html"]=$dati["html"].' <div class="form-check">
                                <input class="form-check-input corsi-fl" type="checkbox" name="corsiFlSel[]" value="'.$row["cod_corso"].'" id="'.$row["cod_corso"].'" '.$disabled.'>
                                <label class="form-check-label" for="'.$row["cod_corso"].'">'.'<a href="'.$row["link_info"].'" target="_blank">'.
                                    $row["nome"].' '.$full.'</a>'
                                .'</label>
                            </div>';
            
        }
        $dati["esito"]="success";
        //throw new Exception(print_r($dati["html"],true));
        $dati["html"]=mb_convert_encoding($dati['html'], 'UTF-8', 'UTF-8');
        $json=json_encode($dati);
        if ($json)
            echo $json;
        else
            echo json_last_error_msg();
    }
    catch(Exception $e)
    {
            $dati["esito"]="err_exc";
            $dati["html"]=$e->getMessage();
            echo json_encode($dati);
    }
?>