<?php
class dbConnect
{
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $db;

    public function __construct($host, $dbName, $username, $password)
    {
        $this->host=$host;
        $this->dbName=$dbName;
        $this->username=$username;
        $this->password=$password;
    }

    public function connect()
    {
        $str='mysql:host=' .$this->host . '; dbname='. $this->dbName;
      
        try 
        {
            //!!!!!!!!!!!! Qui c'è l'errore !!!!! tu avevi scritto $this->$db
            $this->db = new PDO($str, $this->username, $this->password);
        }
          
           catch (PDOException $e) 
            {
                echo "Connessione al DB non riuscita: ".$e;
                die();
            }
        return $this->db;
    }
    public function query($query,$parameters=[])
    {
        $stmt= $this->db->prepare($query); 

        if(!$stmt->execute($parameters))
        
        {
            echo "Errore nell'esecuzione della query: ";
            print_r($stmt->errorInfo());
        } 
        return $stmt;
    }

    public function insert($table, $values)
    {
        $query='INSERT INTO '.$table.'(';
        foreach($values as $key=>$value)
        {
            //QUI c'era un altro errore!!! la parentesi la devi chiudere fuori dal foreach
            //tra una chiave e l'altra dovevi aggiungere il carattere virgola
            //nella funzione ltrim perché usi il . ? ltrim ha due parametri seprati da una VIRGOLA: la stringa e il carattere da eliminare 
            //$query.=' '.ltrim($key.':').')';
            $query.=''.ltrim($key,':').','; 
        }

        $query=rtrim($query,',').') VALUES(';
        
        foreach($values as $key=>$value)
        {
            $query.=$key.','; 
        }

        $query=rtrim($query,',').')';
        echo $query;
        $stmt=$this->query($query,$values);
        return $stmt;
    }
}
?>