<?php
    function giornoSett($data_app)
    {
        $dataIns=new DateTime($data_app);
        $dayWeek=$dataIns->format('N'); //giorno della settimana (1 Monday - 7 Sunday)
        return $dayWeek;
    }
    function validDate($data_app)
    {
        $dataIns=new DateTime($data_app);
        $today=New DateTime();
        $dataIns=$dataIns->getTimestamp();
        $today=$today->getTimestamp();
        if($dataIns<$today)
        {            
            return false;
        }
        
        return true;
    }
    function dataModificabile($data_disp)
    {
        $dateIns=new DateTime($data_disp);
        $dateIns->setTime(0,0);
        $dateIns=$dateIns->getTimestamp();
        $dateToday=new DateTime();
        $dateToday->setTime(0,0);
        $dateToday=$dateToday->getTimestamp();
        if($dateIns>=$dateToday)
        {
            return true;
            
        }
        return false;
    }

    function dataFormatoIta($data_app)
    {
        $dateIns=new DateTime($data_app);
        return $dateIns->format('d-m-Y');
    }

    function inviaMail($to, $subject, $html_msg)
    {
        $mail_boundary = "=_NextPart_" . md5(uniqid(time()));

            $sender = "postmaster@isisdavinciprenotazioni.it";


            $headers = "From: $sender\n";
            $headers .= "Bcc:postmaster@isisdavinciprenotazioni.it\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
            $headers .= "X-Mailer: PHP " . phpversion();
            
            
            
            $msg .= "\n--$mail_boundary\n";
            $msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
            $msg .= "Content-Transfer-Encoding: 8bit\n\n";
            $msg .= $html_msg;  // aggiungi il messaggio in formato HTML
            
            // Boundary di terminazione multipart/alternative
            $msg .= "\n--$mail_boundary--\n";
            
            // Imposta il Return-Path (funziona solo su hosting Windows)
            //ini_set("sendmail_from", $sender);
            
            // Invia il messaggio, il quinto parametro "-f$sender" imposta il Return-Path su hosting Linux
            if (mail($to, $subject, $msg, $headers, "-f$sender")) { 
                echo "è stata inviata una mail di conferma al suo indirizzo email";
            } else { 
                echo "<br><br>Recapito e-Mail fallito!";
            }
    }
?>