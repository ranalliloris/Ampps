<form id="form-app">
    <p class="text-danger">Il Sistema di prenotazioni sarà attivo dal 29 giugno 2020 al 7 luglio 2020. 
    </p>
    <div id="dati-utente">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dati Studente</h5>
                        <div class="form-group">
                            <label for="cf_stud">Codice Fiscale Studente<span class="req">*</span></label>
                            <input class="form-control form-control-sm" type="text" name="cf_stud" id="cf_stud" maxlength="16">
                            <p id="err_cf_stud" class="req err-form"></p>
                        </div>
                        <div class="form-group">
                            <label for="cognome_stud">Cognome Studente<span class="req">*</span></label>
                            <input class="form-control form-control-sm" type="text" name="cognome_stud" id="cognome_stud" maxlength="80">
                            <p id="err_cog_stud" class="req err-form"></p>
                        </div>
                        <div class="form-group">
                        <label for="nome_stud">Nome Studente<span class="req">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="nome_stud" id="nome_stud" maxlength="80">
                        <p id="err_nome_stud" class="req err-form"></p>
                        </div>
                        <p class="req">* Campo Obbligatorio</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dati Genitore</h5>
                        <div class="form-group">
                            <label for="cognome_gen">Cognome Genitore<span class="req">*</span></label>
                            <input class="form-control form-control-sm" type="text" name="cognome_gen" id="cognome_gen" maxlength="80">
                            <p id="err_nome_gen" class="req err-form"></p>
                        </div>

                        <div class="form-group">
                            <label for="nome_gen">Nome Genitore<span class="req">*</span></label>
                            <input class="form-control form-control-sm" type="text" name="nome_gen" id="nome_gen" maxlength="80">
                            <p id="err_cog_gen" class="req err-form"></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Genitore<span class="req">*</span></label>
                            <input class="form-control form-control-sm" type="email" name="email" id="email" maxlength="50">
                            <p id="err_email" class="req err-form"></p>
                        </div>
                        <div class="form-group">
                            <label for="cellulare">Cellulare Genitore<span class="req" >*</span></label>
                            <input class="form-control form-control-sm" type="text" name="cellulare" id="cellulare" maxlength="15">
                            <p id="err_cell" class="req err-form"></p>
                        </div>
                        <p class="req">* Campo Obbligatorio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dati-calendar">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Appuntamento</h5>
                        <p>I giorni e gli orari di ricevimento della segreteria sono i seguenti:</p>
                            <?php
                                require_once "./templates/tabella-orari-seg.php";
                            ?> 
                        </table>
                        <div class="form-group">
                            <p class="text-danger">Sono selezionabili le date comprese tra il 1 Luglio 2020 e il 24 Luglio 2020.
                            </p>
                            
                            <label for="data_app">Inserire la Data<span class="req">*</span></label>
                            <div class="input-group mb-3 col-md-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Data (gg-mm-aaaa)</span>
                                </div>
                                <input class="form-control" type="date" name="data_app" id="data_app" min="2020-07-01" placeholder="gg-mm-aaaa">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="btn-cerca-data">Cerca</button>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dati-fasce-orarie" class="text-center">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Fasce Orarie disponibili</h5>
                        <div class="form-group" id="fasce-orarie">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="dati-conferma-app" class="text-center">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Esito richiesta Appuntamento</h5>
                        <div class="form-group" id="conferma-app">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="error-cmdline">
        <p class="req" id="error"></p>
        <p class="text-center">
            <a href="index.php" class="btn btn-primary" id="btn-home">Torna alla Home</a>
            <a href="" class="btn btn-primary" id="btn-prev">Indietro</a>
            <a href="" class="btn btn-primary" id="btn-next">Avanti</a>
            <a href="" class="btn btn-primary" id="btn-conferma">Conferma</a>
        </p>
    </div>

    
</form>