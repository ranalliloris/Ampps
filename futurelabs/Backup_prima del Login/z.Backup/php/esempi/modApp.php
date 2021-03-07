<?php
    include_once (__DIR__.'/../templates/session.php');
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $codice=$_POST["codice"];
    $data_app_new=$_POST["data_app"];
    $id_fascia_new=$_POST["id_fascia"];
    
    try
    {
        if(validDate($data_app_new)==false)
        {
            throw new Exception('<p class="req">Data NON VALIDA</p>');
                    
        }

        $query=' SELECT a.cf_stud, data_app
                 FROM studente as s, appuntamento as a
                 WHERE s.cf_stud=a.cf_stud AND a.codice="'.$codice.'"';
        $stmt=$dbconn->query($query);
        $row=$stmt->fetch();
        if($row==null)
        {
            throw new Exception('<p class="req">Errore nella modifica dell\'Appuntamento che non risulta più esistente</p>');
        }
        $cf_stud=$row["cf_stud"];
        $data_app_old=$row["data_app"];

        $query=" SELECT a.cf_stud
                 FROM appuntamento as a, fasciaoraria as f
                 WHERE a.cf_stud=:cf_stud 
                 AND a.data_app=:data_app_new AND a.data_app<>:data_app_old";
       
       $parameters=[":cf_stud"=>$cf_stud,
                     ":data_app_new"=>$data_app_new,
                     ":data_app_old"=>$data_app_old
                    ];
        
        $stmt=$dbconn->query($query,$parameters);
       
        $row=$stmt->fetch();
        if($row!=null)  //se l'utente sta cercando di cambiare la nuova data in una dove ha già un appuntamento
        {
            throw new Exception('<p class="req">Errore nella modifica dell\'Appuntamento. 
            Risulta che nel giorno indicato risulti già prenotato un appuntamento a suo nome</p>');
        }
        
        if(!$reserved || $_SESSION['ruolo']!="segreteria") //Consento alla segreteria di prenotare gli appuntamenti senza limitazioni
            { 
                if($dbconn->outOfRangeApp_Mod($data_app_new,$cf_stud, $data_app_old))
                {
                    throw new Exception('<p class="req">Errore nella modifica dell\'Appuntamento. Risulta che nei 7 giorni precedenti o nei 7 giorni successivi alla data scelta ci sia già una prenotazione a suo nome</p>');
                }
            }

        $esitoFreeFascia=$dbconn->isFreeFascia($dbconn->getFasceOccupate($data_app_new),$id_fascia_new);
        if($esitoFreeFascia==true)
        {
            $newVal=[":data_app"=>$data_app_new,
                     ":id_fascia"=>$id_fascia_new];
            $condizione=[":codice"=>$codice,
                        ];
            
            
            $esito=$dbconn->update("appuntamento",$newVal,$condizione);
            $oraApp=rtrim($dbconn->ora_scelta,"00");
            $oraApp=rtrim($oraApp,":");
            echo '<h5 class="text-success">Appuntamento modificato correttamente</h5>
            <p>Nuovi dati dell\'appuntamento:</p>
                    <p><b>Data Appuntamento: </b>'.dataFormatoIta($data_app_new).'</p>
                    <p><b>Ora appuntamento: </b>'.$oraApp.'</p>';

            
            $html_msg='<h3>Modifica Appuntamento</h3>
                        <p>Confermiamo che la modifica da Lei richiesta è stata registrata. Inviamo i nuovi dati dell\'appuntamento:
                        <p>Data Appuntamento: '.dataFormatoIta($data_app_new).'</p>
                        <p>Ora appuntamento: '.$oraApp.'</p>
                        <h5 style="color:#28a745">Codice Appuntamento: '.$codice.'</h5>
                        <p>Il codice appuntamento può essere usato per modificare/cancellare la prenotazione</p>
                        <p>Per qualunque informazione o richiesta contattare la segreteria didattica all\'indirizzo
                        mail <a href="mailto:segreteriadidattica@isisdavinci.eu">segreteriadidattica@isisdavinci.eu</a></p>
            ';

            $email=$dbconn->getEmail($cf_stud);
            //echo $html_msg;
            inviaMail($email,"Dati Modifica Appuntamento $codice - Segreteria IIS Leonardo Da Vinci",$html_msg);
            echo '<p>Per qualunque informazione o richiesta contattare la segreteria didattica all\'indirizzo
            mail <a href="mailto:segreteriadidattica@isisdavinci.eu">segreteriadidattica@isisdavinci.eu</a></p>
            ';
        
        }


        
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>