    <?php
        session_start();
        require_once (__DIR__.'/../inc/info_glob.inc.php');
        include_once __DIR__.'/../classi/connectionDB.php';
        $dbconn=new dbConnect($hostDB,$userDB,$passwDB,$nameDB);
        $dbconn->connect();
        
        try
        {
            if($dbconn->userExists($_POST["username"]))
            {
                echo '<h5 class="req">Registrazione non effettuata: Utente già registrato</h5>';
                die();
            }
            $values=[       ":username" => $_POST["username"],
                            ":password" => password_hash($_POST["password"],PASSWORD_DEFAULT),
                            ":nome" => $_POST["nome"],
                            ":cognome" => $_POST["cognome"],
                            ":email" => $_POST["email"],
                            ":ruolo" => $_POST["ruolo"]
            ];
            $stmt=$dbconn->insert("utente",$values);
            if($stmt->rowCount()==0)
            {
                echo '<h5 class="req">Errore nell\'inserimento dell\'utente!!!</h5>';
            }
            else
            {
                echo '<h5 class="text-success">Registrazione Avvenuta con successo </h5>';
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            die();
        }
            
    ?>
