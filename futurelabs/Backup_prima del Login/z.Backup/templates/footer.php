    <div class="red-header-line d-print-none"></div>
    <div class="footer d-print-none">
        <p class="ml-3 mb-0 pt-1">
            <strong> Istituto Statale Istruzione Superiore Leonardo Da Vinci</strong> <br>
            Per info o assistenza contattare il supporto digitale all'indirizzo mail
            <a href="mailto:supportodigitale@isisdavinci.eu">supportodigitale@isisdavinci.eu</a> <br>
        </p>

        <ul class="list-group list-group-horizontal" >
            <li class="list-group-item"><a href="note-legali.php">Note Legali</a></li>
            <li class="list-group-item"> <a href="https://web.spaggiari.eu/pvw/app/default/pvw_sito.php?sede_codice=FIII0015&page=2205635">Privacy</a></li>
            <li class="list-group-item"><a href="https://web.spaggiari.eu/pvw/app/default/pvw_sito.php?sede_codice=FIII0015&from=-1&page=-10">Policy Cookie</a></li>
        <?php    
            if($reserved)
            {
                echo '<li class="list-group-item"><a href="logout.php">Logout</a>';
            }
            else
            {
                echo '<li class="list-group-item"><a href="login-segreteria.php">Login Scuola/Gestore</a>';
            }
            
            
            ?>
        </ul>
        <p class="ml-3 mb-0" id="copyright">
        © 2020 Powered by prof. Loris Ranalli | lorisranalli-at-isisdavinci.eu(sostituire -at- con @)<br>
        </p>
    </div>
<!-- CHIUSURA DIV CONTAINER -->
</div>
<script src="js/validate.js?<?php echo filemtime("js/validate.js"); ?>"></script>
<script src="js/corsi/iscrizioni.js?<?php echo filemtime("js/corsi/iscrizioni.js"); ?>"></script>


