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
                throw new Exception('<p class="req">Errore nell\'esecuzione della query userExists: '.print_r($stmt->errorInfo(),true).'/<p>');
            }
            return !empty($stmt->fetchAll());

        }

        public function studenteExists($cf_stud)
        {
            $query="SELECT cf_stud
                    FROM studente
                    WHERE cf_stud=:cf_stud
                    ";
            $stmt=$this->db->prepare($query);
            $parameters=[":cf_stud" => $cf_stud];
            if(!$stmt->execute($parameters))
            {
                throw new Exception('<p class="req">Errore nell\'esecuzione della query userExists: '.print_r($stmt->errorInfo(),true).'/<p>');
            }
            return !empty($stmt->fetchAll());

        }



        //controllare il funzionamento
        public function insertStudente($cf_stud,$cognome_stud,$nome_stud,$cognome_gen,$nome_gen,$email,$cellulare)
        {
            $values=[       ":cf_stud" => $cf_stud,
                            ":cognome_stud" =>$cognome_stud,
                            ":nome_stud" => $nome_stud,
                            ":cognome_gen" => $cognome_gen,
                            ":nome_gen" => $nome_gen,
                            ":email" => $email,
                            ":cellulare" => $cellulare
            ];
            $this->insert("studente",$values);
            
        }

        public function generaCodice($data_app, $cf_stud, $id_fascia)
        {
            $codice="";
            $dataC=new DateTime($data_app);
            $today=new DateTime();
            $time=$today->getTimestamp();
            $d=$dataC->format('d');
            $m=$dataC->format('m');
            $y=$dataC->format('y');
            $codice=hash('crc32',$d.$m.$y.$cf_stud.$id_fascia.$time);
            return $codice;
        }

        public function getAllFasceOrarie()
        {
            $query="    SELECT id, ora_inizio
                        FROM fasciaoraria
                        ORDER BY ora_inizio ASC";
            $stmt=$this->query($query);
            return $stmt->fetchAll();
        }

        public function getFasceOccupate($data_app)
        {
            $query="
                SELECT id, COUNT(id) as posti_occupati
                FROM fasciaoraria as f, appuntamento as a
                WHERE f.id=a.id_fascia AND a.data_app=:data_app
                GROUP BY id;
            ";
            $parameters=[':data_app'=>$data_app];   
            $stmt=$this->query($query,$parameters);
            return $stmt->fetchAll();
        }

        

        public function isFreeFascia($fasceOccupate,$id_fascia)
        {
            
            $arrFasce=$this->generaArrFasce($fasceOccupate);
            $this->ora_scelta=$arrFasce[$id_fascia]->orario;
            if($arrFasce[$id_fascia]->postiLiberi>0)
                return true;
            return false;
        }

        public function generaArrFasce($fascePostiOccupati)
        {
            
            $elencoFasce=$this->getAllFasceOrarie();
            if(count($elencoFasce)>0)
            {
                foreach($elencoFasce as $row)
                {
                    $fasce[$row['id']]=new fasceOrarie(strval($row["ora_inizio"]));
                }

                foreach($fascePostiOccupati as $row)
                {
                    $fasce[$row['id']]->postiLiberi-=$row['posti_occupati'];
                }
            }
            else //l'elenco delle fasce orarie non può essere vuoto
            {
                throw new Exception('<p class="req">La tabella delle fasce orarie è vuota</p>');
            }
            return $fasce;
        }

        public function isInData($cf_stud, $data_app)
        {
            $query="
                SELECT cf_stud
                FROM fasciaoraria as f, appuntamento as a
                WHERE cf_stud=:cf_stud AND a.id_fascia=f.id AND data_app=:data_app
            ";
            $parameters=[':data_app'=>$data_app,
                         ':cf_stud'=>$cf_stud
                        ];   
            $stmt=$this->query($query,$parameters);
            if(count($stmt->fetchAll())>0)
                return true;
            else
                return false;
        }

        public function insertApp($cf_stud,$data_app,$id_fascia)
        {
            if($this->isInData($cf_stud,$data_app))
            {
                throw new Exception('<p class="req">Hai già prenotato un appuntamento per questo giorno</p>');
            }
            $fasceOccupate=$this->getFasceOccupate($data_app);
            if($this->isFreeFascia($fasceOccupate,$id_fascia))
            {
                $codice= $this->generaCodice($data_app, $cf_stud, $id_fascia);
                $values=[       ":codice"=>$codice,
                                ":data_app" => $data_app,
                                ":cf_stud" =>$cf_stud,
                                ":id_fascia" => $id_fascia
                ];
                $this->insert("appuntamento",$values);
                return $codice;
            }
            return "";
            
            
        }

         //ritorna true se si ha un'altra prenotazione nei sette giorni prima o nei 7 dopo per la richiesta appuntamento
        public function outOfRangeApp($data_app,$cf_stud)
        {
            $data_week_prev=new DateTime($data_app);
            $data_week_next=new DateTime($data_app);
            
            $data_week_prev=$data_week_prev->modify('-7 day');
            $data_week_next=$data_week_next->modify('+7 day');
            $query=' SELECT cf_stud, count(cf_stud) as appPren
                     FROM appuntamento, fasciaoraria
                     WHERE cf_stud=:cf_stud AND data_app>:data_week_prev AND data_app<:data_week_next
                     GROUP BY cf_stud
                    ';
            $values=[   ":cf_stud" => $cf_stud,
                        ":data_week_prev"=>$data_week_prev->format('Y-m-d'),
                        ":data_week_next"=>$data_week_next->format('Y-m-d')
                    ];
            $stmt=$this->query($query,$values);
            $row=$stmt->fetch();
            if($row["appPren"]>=1)
            {
                return true;
            }
            return false;
        }
        
        //ritorna true se si ha un'altra prenotazione nei sette giorni prima o nei 7 dopo quando si modifica l'app
        public function outOfRangeApp_Mod($data_app,$cf_stud, $data_app_old)
        {
            $data_week_prev=new DateTime($data_app);
            $data_week_next=new DateTime($data_app);
            
            $data_week_prev=$data_week_prev->modify('-7 day');
            $data_week_next=$data_week_next->modify('+7 day');
            $query=' SELECT cf_stud, count(cf_stud) as appPren
                     FROM appuntamento, fasciaoraria
                     WHERE cf_stud=:cf_stud AND data_app>:data_week_prev AND data_app<:data_week_next
                     AND data_app<>:data_app_old
                     GROUP BY cf_stud
                    ';
            $values=[   ":cf_stud" => $cf_stud,
                        ":data_week_prev"=>$data_week_prev->format('Y-m-d'),
                        ":data_week_next"=>$data_week_next->format('Y-m-d'),
                        ":data_app_old"=>$data_app_old
                    ];
            $stmt=$this->query($query,$values);
            $row=$stmt->fetch();
            if($row["appPren"]>=1)
            {
                return true;
            }
            return false;
        }

        
        public function userVerify($username,$password)
        {
            $query="SELECT username, password, ruolo
                    FROM utente
                    WHERE username=:username
                    ";
            $parameters=[":username" => $username];

            $stmt=$this->query($query,$parameters);
            $row=$stmt->fetch();
            $esito=["verify"=>"", "error"=>"", "password"=>null, "ruolo"=>""];
            if($row==null)
            {

                $esito["verify"]=false;
                $esito["error"]="username";
                return $esito;
            }
            $userPassword=$row["password"];
            if(!password_verify($password,$userPassword))
            {
                $esito["verify"]=false;
                $esito["error"]="password";
                return $esito;
            }
            $esito["verify"]=true;
            $esito["error"]="";
            $esito["password"]=$userPassword;
            $esito["ruolo"]=$row["ruolo"];
            return $esito;
                
        }

        function SessionUserVerify($session_usr, $session_pwd)
        {
            $query="SELECT username, password
            FROM utente
            WHERE username=:username AND password=:password
            ";
            $parameters=[":username" => $session_usr,
                         ":password" => $session_pwd
            ];
            
            $stmt=$this->query($query,$parameters);
            $row=$stmt->fetchAll();
            if(count($row)>0)
            {
                return true;
                
            }
            
            return false;
        }

        function isLoggedin()
        {
            if(empty($_SESSION['username']))
            {
                return false;
                
                
            }
            
            $esito=$this->SessionUserVerify($_SESSION['username'],$_SESSION["password"]);
            return $esito;
            
        }


        public function getEmail($cf_stud)
        {
            $query="SELECT email
                    FROM studente
                    WHERE cf_stud=:cf_stud";
            $parameters=[":cf_stud"=>$cf_stud];
            $stmt=$this->query($query,$parameters);
            $row=$stmt->fetch();
            return $row["email"];
        }

        function elencoAppData($data)
        {
            $query="SELECT codice, cognome_stud, nome_stud, cognome_gen, nome_gen, ora_inizio
                    FROM studente as s, appuntamento as a, fasciaoraria as f
                    WHERE s.cf_stud=a.cf_stud AND a.id_fascia=f.id AND a.data_app=:data_app
                    ORDER BY ora_inizio ASC, cognome_stud ASC, nome_stud ASC
            ";

            $parameter=[":data_app"=>$data];
            $stmt=$this->query($query, $parameter);
            return $stmt;
        }
        
        //Ricerca tutti gli appuntamenti successivi alla data passata come parametro
        function elencoAppDataFrom($data)
        {
            $query="SELECT codice, cognome_stud, nome_stud, cognome_gen, nome_gen, data_app, ora_inizio, cellulare, email
                    FROM studente as s, appuntamento as a, fasciaoraria as f
                    WHERE s.cf_stud=a.cf_stud AND a.id_fascia=f.id AND a.data_app>=:data_app
                    ORDER BY data_app ASC, ora_inizio ASC, cognome_stud ASC, nome_stud ASC
            ";

            $parameter=[":data_app"=>$data];
            $stmt=$this->query($query, $parameter);
            return $stmt;
        }
        
        //Ricerca tutti gli appuntamenti precedenti alla data passata come parametro
        function elencoAppDataTo($data)
        {
            $query="SELECT codice, cognome_stud, nome_stud, cognome_gen, nome_gen, data_app, ora_inizio, cellulare, email
                    FROM studente as s, appuntamento as a, fasciaoraria as f
                    WHERE s.cf_stud=a.cf_stud AND a.id_fascia=f.id AND a.data_app<=:data_app
                    ORDER BY data_app ASC, ora_inizio ASC, cognome_stud ASC, nome_stud ASC
            ";

            $parameter=[":data_app"=>$data];
            $stmt=$this->query($query, $parameter);
            return $stmt;
        }

        //Ricerca tutti gli appuntamenti successivi alla data passata come parametro
        function elencoAppDataRange($data_from, $data_to)
        {
            $query="SELECT codice, cognome_stud, nome_stud, cognome_gen, nome_gen, data_app, ora_inizio, cellulare, email
                    FROM studente as s, appuntamento as a, fasciaoraria as f
                    WHERE s.cf_stud=a.cf_stud AND a.id_fascia=f.id AND a.data_app>=:data_from AND a.data_app<=:data_to
                    ORDER BY data_app ASC, ora_inizio ASC, cognome_stud ASC, nome_stud ASC
            ";

            $parameter=[":data_from"=>$data_from, ":data_to"=>$data_to];
            $stmt=$this->query($query, $parameter);
            return $stmt;
        }

        function elencoCognome($cognome_stud)
        {
            $query="SELECT codice, cognome_stud, nome_stud, cognome_gen, nome_gen, ora_inizio, cellulare, email, data_app
                    FROM studente as s, appuntamento as a, fasciaoraria as f
                    WHERE s.cf_stud=a.cf_stud AND a.id_fascia=f.id AND s.cognome_stud LIKE :cognome_stud
                    ORDER BY ora_inizio ASC, cognome_stud ASC, nome_stud ASC
            ";

            $parameter=[":cognome_stud"=>$cognome_stud."%"];
            $stmt=$this->query($query, $parameter);
            return $stmt;
        }
     
        public function delete($table, $condition)
        {
            $query='DELETE FROM '.$table.' WHERE';
            foreach($condition as $key=>$value)
            {
                $query.=' '.ltrim($key,':').'='.$key.' AND';
            }
            $query=rtrim($query,'AND');
            $stmt=$this->query($query,$condition);
            return $stmt;
            
        }
