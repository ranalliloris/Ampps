<?php
class dbConnect
{
    private $host; //contiene l'indirizzo IP del Server DBMS
    private $username; //Username di accesso al DB
    private $password; //Password di accesso al DB
    private $dbName; //Nome del Database al quale vogliamo accedere
    private $db; //Oggetto di connessiona la DB

    public function __construct($host, $username, $password, $dbName) //doppio underscore seguito da construct
    {
        $this->host=$host;
        $this->username=$username;
        $this->password=$password;
        $this->dbName=$dbName;
        $this->db=null;
    }

    public function connect() 
    {
        try
        {
            $strConn='mysql:host='.$this->host.'; dbname='.$this->dbName;
            $this->db=new PDO($strConn,$this->username,$this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return true;
        }
        catch(PDOException $e)
        {
            echo "Connessione non riuscita ".$e;
            return false;
        }
    }

    public function close() // viene richiamato direttamente nel codice $dbc.close()
    {
        $this->db=null;
    }

    public function __destruct() //viene richiamato automaticamente al termine dello script che 
                                // usa la classe dbConnect
    {
        $this->db=null;
    }

    //Siccome queste righe dovranno essere usate anche per la select,
    //la update, la delete 
    public function query($querySql,$values=[])
    {
        $stmt=$this->db->prepare($querySql); //Ritorna un oggetto PDOStatement
        
        if($stmt->execute($values)==false)
        {
            echo "Errore nella query di inserimento: ".
            print_r($stmt->errorInfo(),true);
        }
        return $stmt; //Serve per le query SELECT

    }

    public function insert($table, $values)
    {
        /*
            INSERT INTO articoli(NumArt, Descrizione, Giacenza
            Categoria, Magazzino, PrzUnitario)
            VALUES (:NumArt,:Descrizione,:Giacenza,
                :Categoria,:Magazzino,:PrzUnitario)
        */

        $query="INSERT INTO ".$table."(";

        //Questo foreach lo uso per elencare i campi della tabella
        foreach($values as $key=>$val) //$key=:NumArt $val="AB54"
        {
            $query.="".ltrim($key,":").","; //ltrim rimuove dal primo parametro il carattere contenuto 
                                            //nel secondo parametro partendo da sinistra
                                            //se ho $key=":NumArt" mi toglie i : a sinistra di NumArt
                                            //risultato finale --> "NumArt" 
        }
        $query=rtrim($query,","); //Rimuove dalla query la virgola che si trova in fondo
                                  //alla stringa, cioè a destra della stringa
                                  // INSERT INTO articoli(NumArt,Descrizione,
                                  //Giacenza,Categoria,Magazzino,PrzUnitario -->","<--
        $query.=") VALUES (";

        //Questo foreach lo uso per elencare i segnaposto
        foreach($values as $key=>$val) //$key=:NumArt $val="AB54"
        {
            $query.=$key.","; //NON TOLGO I : PERCHE' MI SERVONO
        }
        $query=rtrim($query,","); 
        $query.=")";
        //echo $query;
        $this->query($query,$values);
    }
    
    /***
    public function insert($table, $values)
    {
        /*
            INSERT INTO articoli(NumArt, Descrizione, Giacenza
            Categoria, Magazzino, PrzUnitario)
            VALUES (:NumArt,:Descrizione,:Giacenza,
                :Categoria,:Magazzino,:PrzUnitario)
        */
        /*
            $values=[
            ":NumArt"=>$_POST["NumArt"],
            ":Descrizione"=>$_POST["Descrizione"],
            ":Giacenza"=>$_POST["Giacenza"],
            ":Categoria"=>$_POST["Categoria"],
            ":Magazzino"=>$_POST["Magazzino"],
            ":PrzUnitario"=>$_POST["PrzUnitario"]
        ];
        
        $query="INSERT INTO ".$table."(NumArt, Descrizione, Giacenza,
                Categoria, Magazzino, PrzUnitario)
                VALUES (:NumArt,:Descrizione,:Giacenza,
                :Categoria,:Magazzino,:PrzUnitario)";
        $stmt=$this->db->prepare($query); //Ritorna un oggetto PDOStatement
        
        if($stmt->execute($values)==false)
        {
            echo "Errore nella query di inserimento: ".
            print_r($stmt->errorInfo(),true);
        }
        /*execute è un metodo di PDOStatement che
        esegue la query preparate nella riga precedente
        e che si occuperà di sostituire i segnaposto
        (:.....) con i relativi valori ad essi associati 
        

    }*/


 

}
?>