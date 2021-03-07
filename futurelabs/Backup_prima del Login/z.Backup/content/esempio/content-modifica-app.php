<form id="form-mod-app">
    <p class="text-danger">Il Sistema di prenotazioni sarà attivo dal 29 giugno 2020 al 7 luglio 2020. 
    </p>
    <div id="dati-appuntamento">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ricerca Appuntamento</h5>
                        <div class="form-group row">
                            <label for="codice" class="col-sm-3 col-form-label">Inserire Codice Appuntamento<span class="req">*</span></label>
                            <input class="form-control form-control-sm col-sm-3 form-block mb-3" type="text" name="codice" id="codice" maxlength="9">
                            <p class="text-center col-sm-2">
                                <a href="" class="btn btn-primary" id="btn-cerca">Cerca</a>
                            </p>
                        </div>
                        <p class="req">* Campo Obbligatorio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="dati-canc-mod">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dati Appuntamento</h5>
                        <div id="card-dati-canc-mod">
                        
                        </div>
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


    <div id="esito" class="text-center">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Esito Modifica/cancellazione Appuntamento</h5>
                        <div class="form-group" id="esito-mod-canc">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="error-cmdline">
        <p class="req" id="error"></p>
        <p class="text-center" id="pulsanti">
            <a href="index.php" class="btn btn-primary" id="btn-home">Torna alla Home</a>
            <a href="" class="btn btn-primary" id="btn-prev">Indietro</a>
            <a href="" class="btn btn-primary" id="btn-next">Avanti</a>
            <a href="" class="btn btn-primary" id="btn-conferma">Conferma</a>
        </p>
    </div>

    
</form>