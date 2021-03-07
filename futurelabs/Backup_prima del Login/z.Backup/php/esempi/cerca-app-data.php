<?php
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $data_app=$_POST["data-app"];

    
    try
    {
        $stmt=$dbconn->elencoAppData($data_app);
        $rows=$stmt->fetchAll();
        if(count($rows)>0)
        {
            $i=1;
            echo '<table id="tab-app" class="table text-resize">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">#</th>
                                    <th scope="col">Codice</th>
                                    <th scope="col">Studente</th>
                                    <th scope="col">Genitore</th>
                                    <th scope="col">Ora Appuntamento</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach($rows as $row)
            {
                $ora=rtrim($row["ora_inizio"],"0");
                $ora=rtrim($ora,":");
                echo'       <tr>
                                <td>'.$i.'</td>
                                <td>'.$row["codice"].'</td>
                                <td>'.$row["cognome_stud"].' '.$row["nome_stud"].'</td>
                                <td>'.$row["cognome_gen"].' '.$row["nome_gen"].'</td>
                                <td>'.$ora.'</td>
                            </tr>';
                $i++;   

            }
            echo '</tbody>
            </table>';
        }
        else
        {
            echo '<p class="req"> Non sono stati prenotati appuntamenti per questa data </p>';
        }

    }

    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>