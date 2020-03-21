<?php
    $d=$_POST["DataP"];
    $data=new DateTime($d);
    echo $data->format('Y-m-d');
    
?>