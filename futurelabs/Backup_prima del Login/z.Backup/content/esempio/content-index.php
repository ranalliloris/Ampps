    <div id="content">
    
            <a class="btn btn-primary btn-lg btn-block" href="./appuntamento.php">Prenota Appuntamento</a><br>
            <a class="btn btn-primary btn-lg btn-block" href="./modificaAppuntamento.php">Gestisci Appuntamento</a> <br>
        <?php
           if($reserved)
            {
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./visualizza-app-oggi.php">Visualizza Appuntamenti di oggi</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./filtraApp.php">Filtra Appuntamenti</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./filtra-range-date.php">Filtra Appuntamenti in un range di date</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./logout.php">Logout</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./registra-utente.php">Registra Utente</a> <br>';
            }
            else
            {
                echo '<a class="btn btn-primary btn-lg btn-block" href="./odontotecnici/index.php">Iscrizione Esame Abilitazione Odontotecnici</a> <br>';   
            }
        ?>
    </div>