<?php
    require_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
   
    $codice=$_POST["codice"];
    
    try
    {
        $query=" SELECT cognome_stud, nome_stud, data_app, ora_inizio
                 FROM appuntamento as a, fasciaoraria, studente as s 
                 WHERE codice=:codice AND s.cf_stud=a.cf_stud AND id_fascia=id
                ";
        $parameters=[":codice"=>$codice];
        $stmt=$dbconn->query($query,$parameters);
        $row=$stmt->fetch();
        if($row!=null)
        {
            $ora=rtrim($row["ora_inizio"],"0");
            $ora=rtrim($ora,":");
            echo' <table class="table text-resize">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">Cognome</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data Appuntamento</th>
                                    <th scope="col">Ora Appuntamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$row["cognome_stud"].'</td>
                                    <td>'.$row["nome_stud"].'</td>
                                    <td>'.dataFormatoIta($row["data_app"]).'</td>
                                    <td>'.$ora.'</td>
                                </tr>
                            </tbody>
                    </table>
                    <p class="text-center">
                        <a href="index.php" class="btn btn-primary" id="btn-home_cerca">Torna alla Home</a>
                        <a href="" class="btn btn-primary" id="btn-mod">Modifica Data</a>
                        <a href="" class="btn btn-primary" id="btn-canc">Cancella</a>
                    </p>
                    
                    ';

        }
        else
        {
            throw new Exception('<p class="req">Codice Appuntamento non trovato. Controllare che sia corretto e riprovare</p>');
        }
        
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>