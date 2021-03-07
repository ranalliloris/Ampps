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
                throw new Exception('Errore nell\'esecuzione della query:'.print_r($stmt->errorInfo(),true));
            }
            return $stmt;
        }


        public function insert($table, $values)
        {
            $query='INSERT INTO '.$table.'(';
            foreach($values as $key=>$value)
            {
                $query.=' '.ltrim($key,':').','; //ltrim($str,':'); leftTrim (toglie il carattere a sinistra di str)
                                                //rtrim($str,':'); rightTrim (toglie il carattere a destra di str)
            }
        
            $query=rtrim($query,',').') VALUES('; 
            
   
            
            foreach($values as $key=>$value)
            {
                $query.=$key.',';
            }
     
            $query=rtrim($query,',').')';
            //echo $query;
            $stmt=$this->query($query,$values);
            return $stmt;
        }
        
        
        public function update($table, $newVal,$condition)
        {
            $query='UPDATE '.$table.' SET';
            foreach($newVal as $key=>$value)
            {
                $query.=' '.ltrim($key,':').'='.$key.',';
            }
            $query=rtrim($query,',');
            $query.=' WHERE';
            foreach($condition as $key=>$value)
            {
                $query.=' '.ltrim($key,':').'='.$key.' AND';
            }
            $query=rtrim($query,'AND');
            $condition = array_merge($newVal, $condition); //fondo tutti i segnaposto in un unico array
            $stmt=$this->query($query,$condition);
            return $stmt;
        }
        
        /*Funzione update migliorata da Martelli
        public function update($table, $newVal,$condition)
        {
            $query='UPDATE '.$table.' SET';
            foreach($newVal as $key=>$value)
            {
                $query.=' '.ltrim($key,':').'='.$key.',';
            }
            $query=rtrim($query,',');
            $query.=' WHERE';
            foreach($condition as $key=>$value)
            {
                $query.=' '.ltrim($key,':').'='.$key.' AND';
            }
            $query=rtrim($query,'AND');
        
            $condition = array_merge($newVal, $condition);
            $esito=$this->query($query,$condition);
            return $esito;
        }*/

        public function __destruct()
        {
            $this->db=null;
        }
    }
?>