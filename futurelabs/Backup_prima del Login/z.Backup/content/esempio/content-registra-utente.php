<div id="content">
    <?php
    if(!$reserved)
        {
            echo '<h5 class="req">Utente non autorizzato alla registrazione!</h5>';
            echo    '<p class="text-center">
                        <a href="index.php" class="btn btn-primary" id="btn-home-2">Torna alla Home</a>
                    </p>';
        }
    else{
    ?>
    <form id="form-registra-utente" class="px-4 py-3">
        <div class="row mb-2 row justify-content-sm-center" id="login-card">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Registra Utente</h5>
                        <div class="form-group">
                            <label>Cognome</label>
                            <input type="text" class="form-control" id="cognome" name="cognome" placeholder="Cognome" required>
                        </div>
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                            <p id="err_email" class="req err-form"></p>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <p id="err_username" class="req err-form"></p>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" data-toggle="password" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="re-password" name="re-password" placeholder="Ripeti Password" data-toggle="password" required>
                        </div>
                        <p id="err_password" class="req err-form"></p>
                        <div class="form-group">
                            <label>Ruolo</label>
                            <select name="ruolo" class="form-control" id="ruolo">
                                <option value="admin">Admin</option>
                                <option value="segreteria">Segreteria</option>
                                <option value="seg_odo">Segreteria Abilitazione ODO</option>
                            </select>
                        </div>
                        <a href="" class="btn btn-primary" id="btn-registra">Registra</a>
                        <a href="" class="btn btn-primary" id="btn-clear">Clear</a>
                        <a href="index.php" class="btn btn-primary">Torna alla Home</a>
                        <div id="error-cmdline">
                            <p class="req" id="error"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </form>
    <div id="dati-conferma-reg" class="text-center">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Esito Registrazione</h5>
                        <div class="form-group" id="conferma-reg">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center">
            <a href="index.php" class="btn btn-primary" id="btn-home">Torna alla Home</a>
    </p>
    <?php
    }
    ?>

</div> <!-- CHIUSURA DIV CONTENT-->