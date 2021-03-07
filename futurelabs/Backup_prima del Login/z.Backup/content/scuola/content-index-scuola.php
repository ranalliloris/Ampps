<?php
    if($reserved==false || $auth==false)
    {
        require_once "content/not-authorized.php";
    }
    else
    {
?>
<div id="content">
    <a class="btn btn-primary btn-lg btn-block col-lg-6 mx-auto" href="./controller.php?path=scuola&service=content-modifica-ricreazioni.php">Modifica Ricreazioni</a><br>
    <a class="btn btn-primary btn-lg btn-block col-lg-6 mx-auto" href="./controller.php?path=scuola&service=content-registra-utente.php">Registra Utente</a><br>
    <a class="btn btn-primary btn-lg btn-block col-lg-6 mx-auto" href="./controller.php?path=scuola&service=content-visualizza-ordini.php">Visualizza Ordini Effettuati</a><br>
    <a class="btn btn-primary btn-lg btn-block col-lg-6 mx-auto" href="./controller.php?path=scuola&service=content-profilo.php">Profilo Utente</a><br>
    <a class="btn btn-primary btn-lg btn-block col-lg-6 mx-auto" href="logout.php">Logout</a> <br>
</div>
<?php
    } //CHIUSO ELSE
?>