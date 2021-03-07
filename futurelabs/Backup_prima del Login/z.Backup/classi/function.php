<?php

function elencoCorsi($dbconn)
{  
    $query="SELECT c.cod_corso, c.nome, c.max_partecipanti, COUNT(c.cod_corso) as iscrizioni
            FROM corso as c
                LEFT JOIN iscrizione as i
                ON c.cod_corso=i.cod_corso
            GROUP BY c.cod_corso";
    return $dbconn->query($query);
}

function iscrittiCorso($dbconn,$corso)
{
    $query="SELECT COUNT(*) as nIscritti, c.max_partecipanti
            FROM iscrizione as i, corso as c
            WHERE i.cod_corso=c.cod_corso AND i.cod_corso=:cod_corso";
    $parameters=[":cod_corso" => $cod_corso];
    $stmt=$dbconn->query($query, $parameters);
    $row=$stmt->fetch();
    return $row;

}

function PersonaExists($dbconn, $cf)
{
    $cf=strtoupper($cf);
    
    $query="SELECT *
            FROM persona as p
            WHERE p.cf=:cf
            ";
     
    $parameters=[":cf" => $cf];
    
    $stmt=$dbconn->query($query, $parameters);
    
    $row=$stmt->fetchAll();
    if(count($row)==0)
    {
        return false;
    }
    else
    {
        return true;
    }
}

//USATA NEL FILE ISCRIZIONE.PHP
function insertPersona($dbconn,$cf,$cognome,$nome,$email,$materia_insegnamento,$classe_concorso,$istituto,$meccanografico)
{
    $values=[       ":cf"=>$cf,
                    ":cognome"=>$cognome,
                    ":nome"=>$nome,
                    ":email"=>$email,
                    ":materia_insegnamento"=>$materia_insegnamento,
                    ":classe_concorso"=>$classe_concorso,
                    ":istituto"=>$istituto,
                    ":meccanografico"=>$meccanografico
            ];
    $dbconn->insert("persona",$values);
}

//Funzione che conta il numeri di corsi ai quali è iscritta una persona e quali
function corsiIscrizionePersona($dbconn,$cf)
{
    $query="SELECT cf,COUNT(cod_corso) as numCorsi
            FROM iscrizione
            WHERE cf=:cf
            GROUP BY cf";
    $parameters=[":cf" => $cf];
    $stmt=$dbconn->query($query,$parameters);
    $row=$stmt->fetch();
    $corsiIsc["numCorsi"]=$row["numCorsi"];
    
    $query="SELECT i.cf, i.cod_corso, c.nome
            FROM iscrizione as i, corso as c
            WHERE i.cod_corso=c.cod_corso AND cf=:cf";
    $parameters=[":cf" => $cf];
    $stmt=$dbconn->query($query,$parameters);
    $rows=$stmt->fetchAll();
    $c=null;
    foreach($rows as $row)
    {
        $c[$row["cod_corso"]]=$row;   
    }
    $corsiIsc["corsi"]=$c; //Ritorno tutte le righe della tabella
    return $corsiIsc;
}

function isIscritto($dbconn,$cf,$corso)
{
    
    $query="SELECT i.cf, i.cod_corso
    FROM iscrizione as i
    WHERE cf=:cf AND i.cod_corso=:cod_corso";
    $parameters=[":cf" => $cf,
                 ":cod_corso"=>$corso
                ];
    
    $stmt=$dbconn->query($query,$parameters);
    
    $rows=$stmt->fetchAll();
    if(count($rows)==0)
        return false;
    return true;

}

function iscrizioneCorsi($dbconn,$cf,$corsi,$codice_iscrizione)
{
    $i=0;
    $codCorsoIscr=null;
    $today=New DateTime();
    $today=$today->format('Y-m-d');
    
    foreach($corsi as $corso)
    {
        $infoCorso=iscrittiCorso($dbconn,$corso);
        //SE NON CI SONO ISCRITTI AL CORSO LA RIGA TORNATA DALLA QUERY E' 0, null, QUINDI SE IL NUMEOR DI ISCRITTI E' 0
        //ALLORA SIGNIFICA CHE NON CI SONO ISCRITTI
        if(!isIScritto($dbconn,$cf,$corso) && ($infoCorso["nIscritti"]==0 || $infoCorso["nIscritti"]<$infoCorso["max_partecipanti"]))
        {   
            $values=[":cf"=>$cf,
                     ":cod_corso"=>$corso,
                     ":data_iscrizione"=>$today,
                     ":codice_iscrizione"=>$codice_iscrizione
                    ];
                    
            $esito=$dbconn->insert("iscrizione", $values);
            if(!$esito)
                    throw new Exception("Errore nella query di iscrizione ai corsi");
            else
            {
               
                $codCorsoIscr[$i]=$corso;
                $i++;
            }
        }
    }

    return $codCorsoIscr;
}

//FUNZIONI LOGIN
function userVerify($dbconn, $username,$password)
        {
            $query="SELECT username, email, password, ruolo
                    FROM utenza as u
                    WHERE u.username=:username 
                    ";
            $parameters=[":username" => $username];

            $stmt=$dbconn->query($query,$parameters);
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

//FUNZIONI SESSION
function SessionUserVerify($dbconn, $session_usr, $session_pwd, $session_ruolo)
    {
        $query="SELECT username, email, password, ruolo
        FROM utenza
        WHERE username=:username AND password=:password AND ruolo=:ruolo
        ";
        $parameters=[":username" => $session_usr,
                        ":password" => $session_pwd,
                        ":ruolo" => $session_ruolo
        ];
        
        $stmt=$dbconn->query($query,$parameters);
        $row=$stmt->fetchAll();
        if(count($row)>0)
        {
            return true;
            
        }
        
        return false;
    }

    function isLoggedin($dbconn)
    {
        if(empty($_SESSION['username']))
        {
            return false;
        }
        
        $esito=SessionUserVerify($dbconn,$_SESSION['username'],$_SESSION["password"],$_SESSION["ruolo"]);
        return $esito;
        
    }
/*
//funzioni registrazione utente
function elencoClassiPlesso($dbconn, $plesso)
{
    $query="SELECT codice
            FROM classe
            WHERE plesso=:plesso;";    
    $parameter=[ ":plesso" => $plesso];
    return $dbconn->query($query, $parameter);

}

function StudentExists($dbconn, $cognome, $nome, $email, $classe)
{
    $nome=strtoupper($nome);
    $cognome=strtoupper($cognome);
    
    $query="SELECT email
            FROM studente as s
            WHERE s.cognome=:cognome AND s.nome=:nome AND s.codice_classe=:codice_classe
            ";
     
    $parameters=[
                    ":cognome" => $cognome,
                    ":nome" => $nome,
                    ":codice_classe" => $classe
    ];
    
    $stmt=$dbconn->query($query, $parameters);
    
    $row=$stmt->fetchAll();
    if(count($row)==0)
    {
        $esito["error"]=true;
        $esito["typeError"]="studente_notverify";
        $esito["msg"]="Studente non trovato nell'elenco della classe. Controlla che i dati siano corretti";
        return $esito;
    }
    if($row[0]["email"]!=null)
    {
        $esito["error"]=true;
        $esito["typeError"]="studente_notverify";
        $esito["msg"]="Lo studente risulta già registro con l'indirizzo email ".$row[0]["email"];
        return $esito;
    }
    $esito["error"]=false;
    return $esito;
}

//FUNZIONI LOGIN
function userVerify($dbconn, $username,$password)
        {
            $query="SELECT s.email, password, ruolo, cnp
                    FROM utenza as u, studente as s
                    WHERE u.email=:username AND s.email=u.email 
                    ";
            $parameters=[":username" => $username];

            $stmt=$dbconn->query($query,$parameters);
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
            $esito["cnp"]=$row["cnp"];
            return $esito;         
        }

//FUNZIONI SESSION
function SessionUserVerify($dbconn, $session_usr, $session_pwd, $session_ruolo)
    {
        $query="SELECT email, password, ruolo
        FROM utenza
        WHERE email=:username AND password=:password AND ruolo=:ruolo
        ";
        $parameters=[":username" => $session_usr,
                        ":password" => $session_pwd,
                        ":ruolo" => $session_ruolo
        ];
        
        $stmt=$dbconn->query($query,$parameters);
        $row=$stmt->fetchAll();
        if(count($row)>0)
        {
            return true;
            
        }
        
        return false;
    }

    function isLoggedin($dbconn)
    {
        if(empty($_SESSION['username']))
        {
            return false;
        }
        
        $esito=SessionUserVerify($dbconn,$_SESSION['username'],$_SESSION["password"],$_SESSION["ruolo"]);
        return $esito;
        
    }

//FUNZIONI DISPONIBILITA GESTORE
function elencoDisp($dbconn, $data_disp)
{
    $query="SELECT d.id_prod, descrizione, tipologia, prezzo, quantita_giorn
            FROM prodotto as p, disponibilità as d
            WHERE p.id_prod=d.id_prod AND d.data_disp=:data_disp
    ";
    $parameters=[":data_disp" => $data_disp];

    $stmt=$dbconn->query($query,$parameters);
    return $stmt;
}

function elencoProdotti($dbconn)
{
    $query="SELECT id_prod, descrizione, tipologia, prezzo, disponibile
            FROM prodotto
            WHERE disponibile=1";

    $stmt=$dbconn->query($query);
    return $stmt;
}

function insertDisponibilita($dbconn, $id_prod, $data_disp, $quantita_giorn)
{
    $values=[       ":id_prod"=>$id_prod,
                    ":data_disp" => $data_disp,
                    ":quantita_giorn" =>$quantita_giorn
            ];
    $dbconn->insert("disponibilità",$values);
}

function aggiornaDisponibilità($dbconn, $id_prod, $data_disp, $quantita_giorn)
{
    $newVal=[":quantita_giorn" =>$quantita_giorn];

    $condizione=[":id_prod"=>$id_prod,
                ":data_disp" => $data_disp
                ];               
    $stmt=$dbconn->update("disponibilità",$newVal,$condizione);
    return $stmt;        
}

//FUNZIONI ORDINA STUDENTE
function prenotazioniProdotto($dbconn, $data_ord)
{
    $query="SELECT p.id_prod, SUM(t.quantita) as qtaOrd
            FROM prodotto as p
                LEFT JOIN (SELECT o.id_ord, l.id_prod, l.quantita
                            FROM ordine as o, lista as l
                            WHERE o.id_ord=l.id_ord AND o.data_ord=:data_ord) as t
                ON p.id_prod=t.id_prod
            WHERE p.disponibile=1
            GROUP BY p.id_prod
            ORDER BY p.id_prod ASC";
    $parameters=[":data_ord" => $data_ord];
    $stmt=$dbconn->query($query,$parameters);
    $rows=$stmt->fetchAll();
    foreach($rows as $row)
    {
        $qtaOrdinate[$row["id_prod"]]=$row["qtaOrd"];
    }
    return $qtaOrdinate;

}

//controlla se l'utente ha già ordinato per la data
function hasReserved($dbconn,$username,$data_ord)
{
    $query="SELECT id_ord
            FROM studente as s, ordine as o
            WHERE s.cnp=o.cnp AND s.email=:username AND o.data_ord=:data_ord  
            ";
    $parameters=[":username" => $username,
    ":data_ord" => $data_ord,
    ];

    $stmt=$dbconn->query($query,$parameters);
    $row=$stmt->fetchAll();
    if(count($row)>0)
    {
        return true;

    }

    return false;
}

function insertOrdine($dbconn, $cnp, $data_ord, $datiToIn)
{
    $values=[       ":data_ord"=>$data_ord,
                    ":pagato" => 0,
                    ":nota_pag" =>NULL,
                    ":cnp"=>$cnp
            ];
    $dbconn->insert("ordine",$values);

    $query="SELECT id_ord
            FROM ordine as o
            WHERE o.data_ord=:data_ord AND o.cnp=:cnp   
            ";
    $parameters=[ ":data_ord"=>$data_ord,
                  ":cnp"=>$cnp
    ];

    $stmt=$dbconn->query($query,$parameters);
    $row=$stmt->fetch();

    foreach($datiToIn as $key=>$value)
    {
        $values=[   ":id_ord"=>$row["id_ord"],
                    ":id_prod"=>$key,
                    ":quantita" => $value,
            ];
        $dbconn->insert("lista",$values);
    }
}
*/
?>