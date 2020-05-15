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

    public function query($query,$parameters=[])
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

    /*
    $query='INSERT INTO province (sigla,provincia,regione)
            VALUES(:sigla,:provincia,:regione)';

            $parameters=[
            ':sigla'=>$_POST["sigla"],
            ':provincia'=>$_POST["provincia"],
            ':regione'=>$_POST["regione"]
             ];

            */
    public function insert($table, $values)
    {
        $query='INSERT INTO '.$table.'(';
        foreach($values as $key=>$value)
        {
            $query.=' '.ltrim($key,':').','; //ltrim($str,':'); leftTrim (toglie il carattere a sinistra di str)
                                            //rtrim($str,':'); rightTrim (toglie il carattere a destra di str)
        }
        //INSERT INTO (sigla,provincia,regione,
        $query=rtrim($query,',').') VALUES('; 
        
        //INSERT INTO (sigla,provincia,regione) VALUES(
        
        foreach($values as $key=>$value)
        {
            $query.=$key.',';
        }
        //INSERT INTO (sigla,provincia,regione) VALUES(:sigla,:provincia,:regione,
        $query=rtrim($query,',').')';
        echo $query;
        $stmt=$this->query($query,$values);
        return $stmt;
    }

    

}

?>