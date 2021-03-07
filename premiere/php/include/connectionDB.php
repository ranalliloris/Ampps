<?php
class dbConnect
{
    private $host; //Contiene l'indirizzo IP del server DBMS
    private $username; //Username di accesso al DB
    private $password; //Password di accesso al DB
    private $dbName; //Nome del Database a cui si vuole accedere
    private $db; //Oggetto di connessione al DB -- NON VA MESSO NEL COSTRUTTORE

    public function __construct($host, $username, $password, $dbName) //Due _
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->db = null;
    } 

    public function connect()
    {
        try
        {
            $strConn= "mysql:host=".$this->host."; dbname=".$this->dbName;
            echo $strConn;
            $this->db = new PDO($strConn,$this->username,$this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return true;
        }
        catch(PDOException $e)
        {
            echo "Connessione Non Riuscita".$e;
            return false;
        }

    }

    public function insert($table, $values)
    {
        /*
            INSERT INTO articoli(NumArt, Descrizione, Giacenza, Categoria, Magazzino, PrzUnitario)
            VALUES(:NumArt,:Descrizione,:Giacenza,:Categoria,:Magazzino,:PrzUnitario);

        */
        $query = "INSERT INTO ".$table."(NumArt, Descrizione, Giacenza, Categoria, Magazzino, PrzUnitario)
        VALUES(:NumArt,:Descrizione,:Giacenza,:Categoria,:Magazzino,:PrzUnitario)";

        $stmt = $this->db->prepare($query); 
        
        if(!$stmt->execute($values))
        {
            echo "Errore nella query di inserimento: ".print_r($stmt->errorInfo(),true);
        }
        /*  
            execute è un metodo di PDOStatment che esegue la query preparata e che si occuperà di sostituire
            i segnaposto(:qualcosa) con i relativi valori ad essi associati
        */
    }

    public function close() //Questo viene richiamato dal codice
    {
        $this->db = null;
    }

    public function __destruct() //Viene richiamato in automatico al termine dello
                                //script che usa la classe dbConnect
    {
        $this->db = null;
    }

}
?>