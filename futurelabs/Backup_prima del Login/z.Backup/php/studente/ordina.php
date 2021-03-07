<?php
    session_start();
    require_once (__DIR__.'/../../inc/info_glob.inc.php');
    include_once (__DIR__.'/../function/funDate.php');
    include_once __DIR__.'/../../classi/connectionDB.php';
    include_once __DIR__.'/../../classi/function.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $data_ord=$_POST["dataOrd"];
    if($data_ord=="")
    {
        $dati["esito"]="err_data";
        $dati["html"]='<p class="req"> Data non selezionata </p>';
        echo json_encode($dati);
        return;
    }

    try
    {

        /************************
         * CONTROLLARE SE L'UTENTE HA GIA' ORDINATO E NEL CASO FOSSE SABATO ORDINARE PER IL LUNEDI'
         */
        if(hasReserved($dbconn, $_SESSION["username"],$data_ord))
        {
            $dati["esito"]="err_data";
            $dati["html"]='<p class="req"> Hai già effettuato un ordine per questa data</p>';
            echo json_encode($dati);
            return;
        }
        $stmt=elencoDisp($dbconn, $data_ord);
        $rows=$stmt->fetchAll();

        /*****
         * OCCORRE SVILUPPARE LA FUNZIONE CHE DECURTA AL TOTALE DELLE DISPONIBILITA'
         * IL QUANTITATIVO GIA' ORDINATO
         */
        $qtaOrd=prenotazioniProdotto($dbconn, $data_ord);
        foreach($rows as $row)
            {
                $disp=($qtaOrd[$row["id_prod"]]!=null)?$row["quantita_giorn"]-$qtaOrd[$row["id_prod"]]:$row["quantita_giorn"];
                if($_POST[$row["id_prod"]]>$disp)
                {
                    throw new Exception('Il prodotto '.$row["descrizione"].' non è più disponibile');
                    //andrebbero aggiornate le disponibilità
                }
                if($_POST[$row["id_prod"]]!=0)
                    $prodToIn[$row["id_prod"]]=$_POST[$row["id_prod"]];
                
            }

            //FUNZIONE CHE CREA UN NUOVO ORDINE E CHE LO INSERISCE IN TABELLA
            insertOrdine($dbconn, $_SESSION["cnp"], $data_ord, $prodToIn);
            $dati["esito"]="success";
            $dati["html"]='<h5 class="text-success text-center">Prenotazione Registrata correttamente</h5>';
            echo json_encode($dati);
    }
    catch(Exception $e)
    {
            $dati["esito"]="err_exc";
            $dati["html"]=$e->getMessage();
            echo json_encode($dati);
    }
?>