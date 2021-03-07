<?php
    if($reserved==true)
    {
        header("Location:./controller.php?path=".$_SESSION["ruolo"]."&&service=content-index-".$_SESSION["ruolo"].".php");
    }
?>
<form id="form-login" class="px-4 py-3">
            <div class="row mb-2 row justify-content-sm-center" id="login-card">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Login</h5>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" data-toggle="password">
                            </div>
                            <a href="" class="btn btn-primary" id="btn-login">Login</a>
                            <div id="error-cmdline">
                                <p class="req" id="error"></p>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="#">Password dimenticata?</a>
                        </div>
                    </div>
                </div>
            </div>
</form>
<script src="js/login-logout.js?<?php echo filemtime("js/registra-utente.js"); ?>"></script>
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>