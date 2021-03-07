<?php

    include_once (__DIR__.'/../templates/session.php');
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $cf_stud=strtoupper($_POST["cf_stud"]);
    $cognome_stud=strtoupper ($_POST["cognome_stud"]);
    $nome_stud=strtoupper ($_POST["nome_stud"]);
    $cognome_gen=strtoupper ($_POST["cognome_gen"]);
    $nome_gen=strtoupper ($_POST["nome_gen"]);
    $email=$_POST["email"];
    $cellulare=$_POST["cellulare"];
    $id_fascia=$_POST["id_fascia"];
    $data_app=$_POST["data_app"];
    try
    {
        if(validDate($data_app)==false)
        {
            throw new Exception('<p class="req">Data NON VALIDA</p>');
                    
        }
        if(!$dbconn->studenteExists($cf_stud))
        {
            $dbconn->insertStudente($cf_stud,$cognome_stud,$nome_stud,$cognome_gen,$nome_gen,$email,$cellulare);
        } 
        else
        {
            if(!$reserved || $_SESSION['ruolo']!="segreteria") //Consento alla segreteria di prenotare gli appuntamenti senza limitazioni
            { echo '<script> alert("'.$_SESSION['ruolo'].'")</script>';
                if($dbconn->outOfRangeApp($data_app,$cf_stud))
                {
                     throw new Exception('<p class="req">Prenotazione NON AVVENUTA. L\'utente può registrare un solo appuntamento ogni 7 giorni</p>');
                    
                }
            }
            
        }
        $codiceApp=$dbconn->insertApp($cf_stud,$data_app,$id_fascia);
        if($codiceApp=="")
        {
            throw new Exception('<p class="req">La fascia oraria scelta non è più disponibile</p>');
        }
        else
        {
            $oraApp=rtrim($dbconn->ora_scelta,"00");
            $oraApp=rtrim($oraApp,":");

            echo '<h5>Data Appuntamento: '.dataFormatoIta($data_app).'</h5>
            <h5>Ora appuntamento: '.$oraApp.'</h5>
            <h5 class="text-success">Codice Appuntamento: <span id="codiceApp">'.$codiceApp.'</span></h5>';
            echo '<p>Si prega di annotare il codice appuntamento in caso di futura modifica o annullamento</p>';
            echo '<p>Cliccare su <b>Torna alla Home</b> per tornare alla Home Page</p>';

            $html_msg='<h3>Conferma Richiesta Appuntamento</h3>
                        <p>Cognome Studente: '.$cognome_stud.'</p>
                        <p>Nome Studente: '.$nome_stud.'</p>
                        <p>Data Appuntamento: '.dataFormatoIta($data_app).'</p>
                        <p>Ora appuntamento: '.$oraApp.'</p>
                        <h5 style="color:#28a745">Codice Appuntamento: '.$codiceApp.'</h5>
                        <p>Il codice appuntamento può essere usato per modificare/cancellare la prenotazione</p>
                        <p>Per qualunque informazione o richiesta contattare la segreteria didattica all\'indirizzo
                        mail <a href="mailto:segreteriadidattica@isisdavinci.eu">segreteriadidattica@isisdavinci.eu</a></p>
            ';
            //echo $html_msg;
            inviaMail($email,"Conferma Appuntamento Segreteria IIS Leonardo Da Vinci",$html_msg);

            
    
        }
        
       
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        echo '<br><p>Cliccare sul Pulsante <b>Indietro</b> per modificare i dati</p>
            <p>Cliccare sul Pulsante <b>Torna alla Home</b> per annullare</p>';
    }
?>