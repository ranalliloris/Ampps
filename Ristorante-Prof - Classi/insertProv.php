<html>
    <head>
        <title>Provincia Inserita</title>
    </head>
   <body>
        <?php
            include __DIR__.'/classi/connectionDB.php';
            $dbconn=new dbConnect('localhost','lorisranalli','lorisranalli','ristorantemarconi');
            $dbconn->connect();
            
            try
            {
                $values=[
                            ':sigla'=>$_POST["sigla"],
                            ':provincia'=>$_POST["provincia"],
                            ':regione'=>$_POST["regione"]
                        ];
                
                $rows=$dbconn->insert($values,"province");
                echo "<h1>Cliente Inserito con successo</h1>";
                
            }
            catch(PDOException $e)
            {
                echo "DB Error: ".$e->getMessage();
                die();
            }
        ?>
    </body>
</html>