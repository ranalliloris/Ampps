<?php
    session_start();
    require_once (__DIR__.'/../../inc/info_glob.inc.php');
    include_once (__DIR__.'/../function/funDate.php');
    include_once __DIR__.'/../../classi/connectionDB.php';
    include_once __DIR__.'/../../classi/function.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $cf=strtoupper($_POST["cf"]);
    $cognome=strtoupper($_POST["cognome"]);
    $nome=strtoupper($_POST["nome"]);
    $email=strtoupper($_POST["email"]);
    $materia_insegnamento=strtoupper($_POST["materia_insegnamento"]);
    $classe_concorso=strtoupper($_POST["classe_concorso"]);
    $istituto=strtoupper($_POST["istituto"]);
    $meccanografico=strtoupper($_POST["meccanografico"]);
    $corsi=$_POST["corsiFlSel"];
    $codice_iscrizione=hash('crc32',$cf);
    //**** GENERARE CODICE PRENOTAZIONE CF CON HASH */
    

    try
    {
        
        /*****
         * CONTROLLARE SE L'UTENTE GIA' ESISTE E IN TAL CASO AGGIORNARE I SUOI DATI
         *
         */
        if(!PersonaExists($dbconn, $cf))
        {
            insertPersona($dbconn,$cf,$cognome,$nome,$email,$materia_insegnamento,$classe_concorso,$istituto,$meccanografico);
        }

         /****
          * CONTROLLARE SE E' ISCRITTO GIA' A DEI CORSI E SE LA SOMMA DEI CORSI SELEZIONATI
          * E' QUELLI AI QUALI E' ISCRITTO E' INFERIORE ALLA QUANTITA' MASSIMA
          */
          
        $corsiIsc=corsiIscrizionePersona($dbconn,$cf);
        //$debug=print_r($corsiIsc,true)." ".$numMaxCorsiIsc; /*** */
        //throw new Exception("Stampa for: ".$debug);
        if($corsiIsc["numCorsi"]>=$numMaxCorsiIsc)
        {
            $dati["esito"]="err_data";
            $dati["html"]='<p class="req">Hai già effettuato l\'iscrizione a '.$numMaxCorsiIsc.' corsi!!!</p>';
            echo json_encode($dati);
            return;
        }
        
          /****
           * ISCRIVERE SOLO AI CORSI AI QUALI NON E' GIA' ISCRITTO
           */
        
        $isc_corsi=iscrizioneCorsi($dbconn, $cf, $corsi, $codice_iscrizione); //Ritorna tutti i corsi dove mi sono iscritto
        
        $corsiIsc=corsiIscrizionePersona($dbconn,$cf);
        $corsiIscPers= $corsiIsc["corsi"];
        $iscrizioniFallite=false;      
        $strCorsiIscritto="";
        

        for($j=0;$j<count($corsi);$j++)
        {
            $corso=$corsi[$j];
            $trovato=false;
            if($isc_corsi!=null)
            {
                for($i=0;$i<count($isc_corsi);$i++)
                {
                    
                    if($corso==$isc_corsi[$i])
                    {
                        $trovato=true;
                    }
                }
            }
            if($trovato)
            {
                //$corsiIscPer non è un $array associativo ma un array semplice
                $p=$corsiIscPers[$corso];
                
                $strCorsiIscritto.="<li>".$p["nome"]."</li>";
            }
            else
            {
                $p=$corsiIscPers[$corso];
                
                $strCorsiNONIscritto.="<li>".$p["nome"]."</li>";
                $iscrizioniFallite=true;
            }
        }
        
        //throw new Exception("Stampa for: ".$debug);/*** */

        $dati["esito"]="success";
        $dati["html"]="";
        if($strCorsiIscritto!="")
        {
            
            $dati["html"]='<h5 class="text-success">L\'iscrizione ai seguenti corsi è avvenuta con successo:</h5>';
            $dati["html"].='<ul>'.$strCorsiIscritto."</ul>";

            $dati["html"].='<h5 class="text-success text-center alert alert-success">Codice Iscrizione: <span id="codiceApp">'.$codice_iscrizione.'</span></h5>';
            $dati["html"].='<p>Si prega di annotare il codice appuntamento utilizzabile per modificare/cancellare l\'iscrizione appena conclusa</p>';
            $str=$dati["html"];
            $dati["html"].='<p>Cliccare su <b>Torna alla Home</b> per tornare alla Home Page</p>';

            $html_msg='<h3>Conferma Iscrizioni Corsi Future Labs IIS L. Da Vinci - Firenze</h3>
                        <p>Cognome: '.$cognome_stud.'</p>
                        <p>Nome: '.$nome_stud.'</p>'.$str.'
                        <h5 style="color:#28a745">Codice Appuntamento: '.$codiceApp.'</h5>
                        <p>Il codice appuntamento può essere usato per modificare/cancellare la prenotazione</p>
                        <p>Per qualunque informazione o richiesta contattare la segreteria didattica all\'indirizzo
                        mail <a href="mailto:segreteriadidattica@isisdavinci.eu">segreteriadidattica@isisdavinci.eu</a></p>
            ';
            //echo $html_msg;
            //inviaMail($email,"Conferma Iscrizioni Corsi Future Labs IIS L. Da Vinci - Firenze",$html_msg);
        }
        if($iscrizioniFallite)
        {
            $dati["html"].='<h5 class="text-danger">L\'iscrizione ai seguenti corsi non è andata a buon fine in quanto risulti già iscritto oppure non ci sono più posti disponibili:</h5>';
            $dati["html"].='<ul class="text-left">'.$strCorsiNONIscritto."</ul>";
        }




        echo json_encode($dati);
        return;
        
    }    
      
    catch(Exception $e)
    {
            $dati["esito"]="err_exc";
            $dati["html"]=$e->getMessage();
            echo json_encode($dati);
    }
?>