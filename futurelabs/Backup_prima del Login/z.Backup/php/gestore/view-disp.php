<?php
    session_start();
    require_once (__DIR__.'/../../inc/info_glob.inc.php');
    include_once (__DIR__.'/../function/funDate.php');
    include_once __DIR__.'/../../classi/connectionDB.php';
    include_once __DIR__.'/../../classi/function.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $data_disp=$_POST["data-disp"];
    if($data_disp=="")
    {
        $dati["esito"]="err_data";
        $dati["html"]='<p class="req"> Data non selezionata </p>';
        echo json_encode($dati);
        return;
    } 
    try
    {
        if(!dataModificabile($data_disp))
        {
            $dati["esito"]="err_data";
            $dati["html"]='<p class="req"> Non si possono modificare le disponibilità di una data passata </p>';
            echo json_encode($dati);
            return;
        }
        $stmt=elencoDisp($dbconn, $data_disp);
        $rows=$stmt->fetchAll();

        $html= '<table id="tab-disp" class="table text-resize">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">codice</th>
                                    <th scope="col">Descrizione</th>
                                    <th scope="col">Tipologia</th>
                                    <th scope="col">Prezzo</th>
                                    <th scope="col">Qtà Disponibile</th>
                                </tr>
                            </thead>
                            <tbody>';

        if(count($rows)==0)
        {
            $stmt=elencoProdotti($dbconn);
            $rows=$stmt->fetchAll();
            if(count($rows)==0)
            {
                throw new Exception("Errore, Nessun prodotto trovato");
            }
            $insDisp=false; //Non sono state ancora inserite
            $dati["typeIns"]="new";
        }
        else
        {
            $insDisp=true;
            $dati["typeIns"]="update";
        }

        foreach($rows as $row)
            {
                $disp=($insDisp==false)?0:$row["quantita_giorn"];
                $html=$html.'       <tr>
                                <td>'.$row["id_prod"].'</td>
                                <td>'.$row["descrizione"].'</td>
                                <td>'.$row["tipologia"].'</td>
                                <td>'.$row["prezzo"].'€ </td>
                                <td class="col-auto">
                                        <input class="form-control text-resize" type="number" id="'.$row["id_prod"].'" name="'.$row["id_prod"].'" min="0" value="'.$disp.'"></td>
                                </tr>';
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