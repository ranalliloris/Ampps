    <div id="content">
    
            <a class="btn btn-primary btn-lg btn-block" href="./appuntamento.php">Prenota Appuntamento</a><br>
            <a class="btn btn-primary btn-lg btn-block" href="./modificaAppuntamento.php">Gestisci Appuntamento</a> <br>
            
            
        <?php
           if($reserved)
            {
                
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./visualizzaAppData.html">Visualizza Appuntamenti di oggi</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./visualizzaApp.html">Filtra Appuntamenti</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./logout.php">Logout</a> <br>';
            }
            else
            {
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./login.html">Login Riservato Segreteria</a> <br>';
                echo '<a  class="btn btn-primary btn-lg btn-block" href="./registra-utente.html">Registra Utente</a> <br>';
            }
        ?>
    </div>