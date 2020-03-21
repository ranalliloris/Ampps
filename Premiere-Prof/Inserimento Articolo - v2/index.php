<?php
    if(!isset($_POST["numArt"]) && !isset($_POST["desc"]))
    {
        include(__DIR__.'/insertArticolo.html');
    }
    else
    {
        include(__DIR__.'/insertArticolo.php');
        include(__DIR__.'/insertArticolo.html');
    }
?>