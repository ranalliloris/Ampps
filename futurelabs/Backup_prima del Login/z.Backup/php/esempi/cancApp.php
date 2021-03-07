<?php
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $codice=$_POST["codice"];
    
    try
    {
        $condizione=[":codice"=>$codice];
        $query="SELECT email
        FROM appuntamento as a, studente as s
        WHERE codice=:codice AND s.cf_stud=a.cf_stud";
        $stmt=$dbconn->query($query,$condizione);
        $row=$stmt->fetch();


        $esito=$dbconn->delete("appuntamento",$condizione);
        
        echo '<h5 class="text-success">Appuntamento Cancellato</h5>';
        

        $html_msg='<h3>Cancellazione Appuntamento</h3>
                    <p>Confermiamo che come da Lei richiesto abbiamo cancellato l\'appuntamento con codice <b>'. 
                    $codice.'</b></p>
                    <p>Per qualunque informazione o richiesta contattare la segreteria didattica all\'indirizzo
                    mail <a href="mailto:segreteriadidattica@isisdavinci.eu">segreteriadidattica@isisdavinci.eu</a></p>
            ';
            //echo $html_msg;
            $email=$row["email"];
            inviaMail($email,"Notifica Cancellazione Appuntamento Segreteria IIS Leonardo Da Vinci",$html_msg);
            
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>