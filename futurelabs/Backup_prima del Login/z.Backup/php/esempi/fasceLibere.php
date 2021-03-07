<?php
    include_once (__DIR__.'/../inc/info_glob.inc.php');
    include_once (__DIR__.'/function/funDate.php');
    include_once __DIR__.'/../classi/fasceOrarie.php';
    include_once __DIR__.'/../classi/connectionDB.php';
    $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
    $dbconn->connect();
    $data_app=$_POST['data_app'];
    $parameters=[];
    try
    {
        $dayWeek=giornoSett($data_app);
        if($data_app=="2020-07-18")
        {
            throw new Exception('<p class="req">Non è possibile selezionare questo giorno</p>');
        }
        if($dayWeek==7)
        {
            throw new Exception('<p class="req">Non è possibile selezionare i giorni festivi</p>');
        }
        if(!dataPrenotabile($data_app,$data_inizio_app,$data_fine_app))
        {
            $dataInit=new DateTime($data_inizio_app);
            $dataClose=new DateTime($data_fine_app);
            throw new Exception('<p class="req">E\' possibile scegliere una data compresa tra il '.$dataInit->format("d-m-Y").
            ' e il '.$dataClose->format("d-m-Y").'</p>');
        }
        
        
        $query="    SELECT id, ora_inizio
                    FROM fasciaoraria";

        if($dayWeek==6) //Se è stato selezionato il sabato
        {
            $strQuery=" WHERE ora_inizio<='12:30:00'";
        }
        if($dayWeek==3 || $dayWeek==4) //se è stato selezionato il mercoledì o il giovedì
        {
            $strQuery="";
        }
        if($dayWeek!=3 && $dayWeek!=4 && $dayWeek!=6 )
        {
            $strQuery=" WHERE ora_inizio<='13:00:00'";
        }
         $query.=$strQuery." ORDER BY ora_inizio ASC";
         $stmt=$dbconn->query($query,$parameters);
         $elencoFasce=$stmt->fetchAll();
    
         $query="
                    SELECT id, COUNT(id) as posti_occupati
                    FROM fasciaoraria as f, appuntamento as a
                    WHERE f.id=a.id_fascia AND a.data_app=:data_app
                    GROUP BY id;
                ";
        $parameters=[':data_app'=>$data_app];   
        $stmt=$dbconn->query($query,$parameters);
        $fascePostiOccupati=$stmt->fetchAll();
        if(count($elencoFasce)>0)
        {
            $sommaFasceLibere=0; //sommo tutti i posti residui per segnalare che non ci sono più fasce prenotabili
            foreach($elencoFasce as $row)
            {
                $fasce[$row['id']]=new fasceOrarie(strval($row["ora_inizio"]));
            }
    
            foreach($fascePostiOccupati as $row)
            {
               $fasce[$row['id']]->postiLiberi-=$row['posti_occupati'];
            }
            
            foreach($fasce as $row)
            {
                $sommaFasceLibere+=$row->postiLiberi;
            }

            if($sommaFasceLibere==0)
            {
                throw new Exception('<p class="req">Non ci sono fasce orarie disponibili per questa data. Scegliere un\'altra data.</p>');
        
            }
            $i=0;
            echo '<div class="row mb-4">';
             
            foreach($fasce as $key=>$value)
            {
               if($value->postiLiberi>0)
               {
                   if($i!=0 && $i%3==0)
                   {
                       echo '<div class="row mb-4">';
                   }
                   $ora=rtrim($value->orario,"0");
                   $ora=rtrim($ora,":");
                   echo '      <div class="col-2 ml-4 mr-4">
                                   <a href="" id="'.$key.'" class="btn btn-success fasciabtn w-30">'.$ora.'</a>
                              </div>
                              ';
                  
                  $i++;
                  if($i%3==0)
                  {
                      echo '</div>';
                  }
               }
                        
            }
            if($i%3!=0)
            {
                echo '</div>';
            }
    
        }
        else
        {
            throw new Exception('<p class="req">Non ci sono fasce orarie disponibili per questa data</p>');
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>