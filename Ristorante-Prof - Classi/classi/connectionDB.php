<?php

    class dbConnect
    {
        private $host;
        private $username;
        private $password;
        private $dbName;
        private $db;

        public function __construct($host,$username,$password,$dbName)
        {
            $this->host=$host;
            $this->username=$username;
            $this->password=$password;
            $this->dbName=$dbName;
        }

        public function connect()
        {
            $strConn='mysql:host='.$this->host.'; dbname='.$this->dbName;
            try
            {
                $this->db=new PDO($strConn,$this->username,$this->password);
            }
            catch(Exception $e)
            {
                echo "Connessione al DB non riuscita con
                username".$this->username." ".$e;
                die();
            }
            return $this->db;

        }

        public function close()
        {
            $this->db=null;
        }

        public function query($sql, $parameters=[])
        {
            $stmt=$this->db->prepare($sql);
            if(!$stmt->execute($parameters))
            {
                echo "Errore nell'esecuzione della query: ";
                print_r($stmt->errorInfo());
                die();
            }
            return $stmt->fetchAll();
        }

        public function insert($values,$table)
        {
            $query='
                    INSERT INTO '.$table.' VALUES(';
            
           

            foreach($values as $key=>$val)
            {
                $query.=''.$key.',';
            }
            $query=rtrim($query,',');
            $query.=')';
            return $this->query($query,$values);
        }    

        public function __destruct()
        {
            $this->db=null;
        }
    }
?>