<?php
session_start();
require_once (__DIR__.'/../inc/info_glob.inc.php');
include_once __DIR__.'/../classi/connectionDB.php';
include_once __DIR__.'/../classi/function.php';
$dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
$dbconn->connect();
if(isLoggedin($dbconn))
{
    $reserved=true;
    if($_GET["path"]==$_SESSION["ruolo"])
    {
        $auth=true;
    }
    else
        $auth=false;
}
else
{
    $reserved=false;
    $auth=false;
    session_destroy();
}
$dbconn=null;
?>