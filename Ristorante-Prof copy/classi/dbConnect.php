<?php
class dbConnect
{
    //atributi della classe
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $db;

    //metodi
    public function __construct($host, $dbName, $username, $password)
    {
        $this->host=$host;
        $this->dbName=$dbName;
        $this->username=$username;
        $this->password=$password;
    }

      public function connect()
    {
       // 'mysql:host=|localhost|; dbname=|ristorantemarconi'
        $str='mysql:host=' . $this->host . '; dbname=' . $this->dbName;
        try
        {
            $this->db=new PDO($str,$this->username,$this->password);
        }
        catch(Exception $e)
        {
            echo "Connessione al DB non riuscita: ".$e;
            die();
        }
        return $this->db;
    }
    public function query($query,$parameters)
    {
        //$stmt=$db->prepare($query);
        $stmt=$this->db->prepare($query); //$db == $this->db

        if(!$stmt->execute($parameters))
            {
                echo "Errore nell'esecuzione della query: ";
                print_r($stmt->errorInfo());
            }
        return $stmt;
    }
    

}

?>