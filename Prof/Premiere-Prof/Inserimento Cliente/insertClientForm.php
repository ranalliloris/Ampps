<html>
    <head>
        <title>Inserimento Cliente</title>
    </head>
    <body>
           <?php
            try
            {
                $db=new PDO('mysql:host=localhost; dbname=premiere','lorisranalli','lorisranalli');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo 'Connessione non riuscita\n'.$e;
                die();
            }
            ?>
        <form action="insertCliente.php" method="POST">
            <label>Codice Cliente</label>
            <input type="text" name="CodC"/>
            <br /> <br />
            <label>Cognome</label>
            <input type="text" name="cognome"/>
            <br /> <br />
            <label>Nome</label>
            <input type="text" name="nome"/>
            <br /> <br />
            <label>Via</label>
            <input type="text" name="via"/>
            <br /> <br />
            <label>città</label>
            <input type="text" name="citta"/>
            <br /> <br />
            <label>Provincia</label>
            <input type="text" name="prov" />
            <br /> <br />
            <label>CAP</label>
            <input type="text" name="cap" />
            <br /> <br />
            <label>Saldo</label>
            <input type="number" name="saldo" step="0.01"/>
            <br /> <br />
            <label>Fido</label>
            <input type="number" name="fido" step="0.01"/>
            <br /> <br />
            <label>Selezionare Rappresentante</label>
            
            <select name="CodR">
            <!-- ################### BLOCCO PHP ELENCO VALORI RAPPRESENTANTE #################### -->    
                <?php
                    try
                    {
                        /*** Preparo la query da eseguire ***/
                        $query='Select CodR
                                From rappresentanti';
                        $pStat=$db->prepare($query);
                        if(!$pStat->execute())
                        {
                            echo "Errore nella query di interrogazione: ";
                            print_r($pStat->errorInfo());   
                        }
                        
                        $rows=$pStat->fetchAll();
                        foreach($rows as $row)
                        {
                            echo '<option value="'.$row["CodR"].'">'.$row["CodR"].'</option>\n';
                        }
                    }
                    catch(PDOException $e)
                    {
                        echo "DB Error: ".$e->getMessage();
                        die();
                    }
                ?>
            <!-- ################################################################################ -->
            </select>
            
            <br /> <br />
            <input type="submit" value="Salva">
            <input type="reset" value="Cancella">
        </form>
        
        
    </body>
</html>