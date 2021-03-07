<?php
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $cognome_stud=$_POST["cognome"];

    
    try
    {
        $stmt=$dbconn->elencoCognome($cognome_stud);
        $rows=$stmt->fetchAll();
        if(count($rows)>0)
        {
            echo '<table id="tab-app" class="table text-resize">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">Codice</th>
                                    <th scope="col">Studente</th>
                                    <th scope="col">Genitore</th>
                                    <th scope="col">Data Appuntamento</th>
                                    <th scope="col">Ora Appuntamento</th>
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
                                <td>'.$row["data_app"].'</td>
                                <td>'.$ora.'</td>
                                <td>'.$row["cellulare"].'</td>
                                <td>'.$row["email"].'</td>
                            </tr>';
                   

            }
            echo '</tbody>
            </table>';
        }
        else
        {
            echo '<p class="req"> Non sono stati trovati appuntamenti per il cognome inserito </p>';
        }

    }

    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>