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
                return null;
            }
            return $stmt;
        }

        /*public function insert($values,$table)
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
        }*/
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


        public function userExists($username)
        {
            $query="SELECT username
                    FROM utente
                    WHERE username=:username
                    ";
            $stmt=$this->db->prepare($query);
            $parameters=[":username" => $username];
            if(!$stmt->execute($parameters))
            {
                echo "Errore nell'esecuzione della query userExists ";
                print_r($stmt->errorInfo());
                return null;
            }
            return !empty($stmt->fetchAll());

        }

        public function nuovoUtente($post)
        {
            $values=[       ":username" => $post["username"],
                            ":password" => password_hash($post["username"],PASSWORD_DEFAULT),
                            ":nome" => $post["nome"],
                            ":cognome" => $post["cognome"],
                            ":email" => $post["email"],
                            ":indirizzo" => $post["indirizzo"],
                            ":numeroCivico" => $post["numeroCivico"],
                            ":cap" => $post["cap"],
                            ":citta" => $post["citta"],
                            ":provincia" => $post["provincia"]
            ];
            return $this->insert('utente',$values);
        }
        
        public function delete($table, $condition)
        {
            $query='DELETE FROM '.$table.' WHERE';
            foreach($condition as $key=>$value)
            {
                $query.=' '.ltrim($key,':').'='.$key.' AND';
            }
            $query=rtrim($query,'AND');
            $esito=$this->query($query,$condition);
            return $esito;
            
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
            $esito=$this->query($query,$condition);
            return esito;
        }

        public function __destruct()
        {
            $this->db=null;
        }
    }
?>