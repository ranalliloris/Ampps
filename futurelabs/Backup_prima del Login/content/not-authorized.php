<?php
if($reserved==true)
{
    $path="./controller.php?path=".$_SESSION["ruolo"]."&&service=content-index-".$_SESSION["ruolo"].".php";
}
else
    $path="controller.php";
?>
<div id="content">
    <p class="text-danger text-center" style="font-size:1.9em">Accesso Negato. Non sei autorizzato</p>
    <a id="btn-home" class="btn btn-primary btn-lg btn-block col-lg-6 mx-auto" href="<?php echo $path; ?>">Home</a><br>
</div>