    <?php
        session_start();
        require_once (__DIR__.'/../inc/info_glob.inc.php');
        include_once __DIR__.'/../classi/connectionDB.php';
        include_once __DIR__.'/../classi/function.php';
        $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
        $dbconn->connect();
        
        try
        {
           $checkStud=StudentExists($dbconn,$_POST["cognome"],$_POST["nome"],$_POST["email"],$_POST["classe"]);
           $dati["esito"]="error";
           $dati["message"]="Esito Check: ".$checkStud["msg"];
            
            if($checkStud["error"])
            {
                $dati["esito"]=$checkStud["typeError"];
                $dati["esitohtml"]=$checkStud["msg"];
            }
            else
            {
                $values=[       ":email" => $_POST["email"],
                                ":password" => password_hash($_POST["password"],PASSWORD_DEFAULT),
                                ":ruolo" => $_POST["ruolo"],
                ];
                $stmt=$dbconn->insert("utenza",$values);
                if($stmt->rowCount()==0)
                {
                    $dati["esito"]="studente_notverify";
                    $dati["esitohtml"]="Errore nella registrazione dell'Account. Riprovare";

                }
                else
                {
                    $newVal=[":email"=>strtolower($_POST["email"]) ];
                    $condizione=[":cognome"=>$_POST["cognome"],
                                 ":nome"=>$_POST["nome"]
                                ];
                    $esito=$dbconn->update("studente",$newVal,$condizione);
                    $dati["esito"]="studente_verify";
                    $dati["esitohtml"]="Account Registrato correttamente";
                }
            }
            echo json_encode($dati);
            
        }
        catch(Exception $e)
        {
            $dati["esito"]="error";
            $dati["message"]=$e->getMessage();
            echo json_encode($dati);
            die();
        }
            
    ?>
