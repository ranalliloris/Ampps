<?php
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $data_from=$_POST["data-from"];
    $data_to=$_POST["data-to"];

    
    try
    {
        if( $data_from=="" && $data_to=="")
        {
            throw new Exception('<p class="req">Non si può effetture la ricerca senza aver indicato un intervallo di date</p>');
            
        }
        else if($data_from!="" && $data_to=="")
        {
            $stmt=$dbconn->elencoAppDataFrom($data_from);
        }
        else if($data_from=="" && $data_to!="")
        {
            $stmt=$dbconn->elencoAppDataTo($data_to);
        }
        else if($data_from!="" && $data_to!="")
        {
            $stmt=$dbconn->elencoAppDataRange($data_from,$data_to);
        }
        else
        {
            throw new Exception('<p class="req">Intervallo di date non valido!!!</p>');
        }
        $rows=$stmt->fetchAll();
        if(count($rows)>0)
        {
            $i=1;
            echo '<table id="tab-app" class="table text-resize">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">Codice</th>
                                    <th scope="col">Studente</th>
                                    <th scope="col">Genitore</th>
                                    <th scope="col">Data Appunt.</th>
                                    <th scope="col">Ora Appunt.</th>
                                    <th scope="col">Cellulare</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach($rows as $row)
            {
                $ora=rtrim($row["ora_inizio"],"0");
                $ora=rtrim($ora,":");
                echo'       <tr>
                                <td>'.$row["codice"].'</td>
                                <td>'.$row["cognome_stud"].' '.$row["nome_stud"].'</td>
                                <td>'.$row["cognome_gen"].' '.$row["nome_gen"].'</td>
                                <td>'.dataFormatoIta($row["data_app"]).'</td>
                                <td>'.$ora.'</td>
                                <td>'.$row["cellulare"].'</td>
                                <td>'.$row["email"].'</td>
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