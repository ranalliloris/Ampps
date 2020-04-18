<?php
    $d=$_POST["DataP"];
    $data=new DateTime($d);
    echo $data->format('Y-m-d'); //m mese in cifre
                                //M mese in testo
                                //d giorni in cifre
                                //D giorno in lettere
    //$pStat->bindParam(":data",$data->format('Y-m-d'));
?>