<?php
        session_start();
        require_once (__DIR__.'/../inc/info_glob.inc.php');
        include_once __DIR__.'/../classi/connectionDB.php';

        $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
        $dbconn->connect();
        $username=$_POST["username"];
        $password=$_POST["password"];

        try
        {   
            $esito=$dbconn->userVerify($username, $password);
            if($esito["verify"])
            {
                $dati["esito"]="user_verifiy";
                $dati["username"]=$username;
                $dati["ruolo"]=$esito["ruolo"]; //[TMP-ODO] - controllo segreteria app odo
                $_SESSION["username"]=$username;
                $_SESSION["password"]=$esito["password"];  //password hash memorizzata nel DB 
                $_SESSION["ruolo"]=$esito["ruolo"]; /////MODIFICATO
                echo json_encode($dati);        
            }
            else
            {
                $dati["esito"]=$esito["error"]."_notverify";
                throw new Exception($esito["error"]);
            }
        }
        catch(Exception $e)
        {
            if($e->getMessage()=="username" || $e->getMessage()=="password")
            {
                echo json_encode($dati);
            }
            else
            {
                $dati["esito"]="error";
                $dati["message"]=$e->getMessage();
                echo json_encode($dati);
            }
                
        }  
    ?>