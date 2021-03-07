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

        $html= '<table id="tab-disp" class="table text-resize">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">Descrizione</th>
                                    <th scope="col">Tipologia</th>
                                    <th scope="col">Prezzo</th>
                                    <th scope="col">Disponibilità</th>
                                    <th scope="col">Quantità</th>
                                </tr>
                            </thead>
                            <tbody>';

        /*****
         * OCCORRE SVILUPPARE LA FUNZIONE CHE DECURTA AL TOTALE DELLE DISPONIBILITA'
         * IL QUANTITATIVO GIA' ORDINATO
         */
        $qtaOrd=prenotazioniProdotto($dbconn, $data_ord);
        foreach($rows as $row)
            {
                
                $disp=($qtaOrd[$row["id_prod"]]!=null)?$row["quantita_giorn"]-$qtaOrd[$row["id_prod"]]:$row["quantita_giorn"];
                if($disp>0)
                {
                    $html=$html.'  <tr>
                                    <td>'.$row["descrizione"].'</td>
                                    <td>'.$row["tipologia"].'</td>
                                    <td>'.$row["prezzo"].'€ </td>
                                    <td>'.$disp.'
                                    <td class="col-auto">
                                            <input class="form-control text-resize '.$row["tipologia"].'" type="number" id="'.$row["id_prod"].'" name="'.$row["id_prod"].'" min="0" value="0"></td>
                                    </tr>';
                }
            }
            $html=$html.'</tbody>
            </table>';
            $dati["esito"]="success";
            $dati["html"]=$html;
            echo json_encode($dati);
    }
    catch(Exception $e)
    {
            $dati["esito"]="err_exc";
            $dati["html"]=$e->getMessage();
            echo json_encode($dati);
    }
?>