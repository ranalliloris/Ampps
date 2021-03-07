<?php
    $data=new DateTime("2020-06-26");
    print_r($data);  
    $data->modify("+15 day");
    //echo $data->format('Y-m-d'); //m mese in cifre
                                //M mese in testo
                                //d giorni in cifre
                                //D giorno in lettere
    //$pStat->bindParam(":data",$data->format('Y-m-d'));
    echo "<br>Day: ".$data->format('d');
    echo "<br>Month: ".$data->format('m');
    echo "<br>Year: ".$data->format('Y');
    $d=$data->format('d');
    $m=$data->format('m');
    $y=$data->format('y');
    $cf="RNLLSM89T27E435U";
    $fascia="900";
    echo "<br>".hash("crc32",$d.$m.$y.$cf.$fascia);
?>
<input type="date" value="aaaa-mm-dd">