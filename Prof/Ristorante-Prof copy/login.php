<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        //connessione al db
        include __DIR__.'/classi/dbConnect.php';
        $dbConn=new dbConnect('localhost','ristorantemarconi','userdb','userdb');
        $db=$dbConn->connect();
        
        //controllo username
        $sql="  SELECT password
                FROM utente
                WHERE username=:username
                ";
        $parameters=[":username"=>$_POST["username"]];
        $stmt=$dbConn->query($sql,$parameters);
        $row=$stmt->fetch();
        if($row==null)
         {
             echo "<h1>Utente e/o password errati</h1>";
         }
         else
         {
            //controllo password
            if(password_verify($_POST["password"],$row["password"]))
            {
                echo "<h1>Benvenuto ".$_POST["username"]."</h1>";
                header("refresh:3;url=./index.html");
                
            }
            else
            {
                echo "<h1>Password errata</h1>";
                header("refresh:3;url=./login.html");
            }
         }
        
    ?>    
</body>
</html>


