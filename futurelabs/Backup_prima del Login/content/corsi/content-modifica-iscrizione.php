
<form id="form-modifica">
    <div id="dati-iscrizione">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ricerca Iscrizione</h5>
                        <div class="form-group row">
                            <label for="codice" class="col-sm-3 col-form-label">Inserire Codice Iscrizione<span class="req">*</span></label>
                            <input class="form-control form-control-sm col-sm-3 form-block mb-3" type="text" name="codice_iscrizione" id="codice_iscrizione" maxlength="9">
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
    <div id="dati-utente">
        <div class="row">
            <div class="col-sm-6 mt-2">
                <div class="card">
                    <div class="card-body" id="dati-persona">
                        <h5 class="card-title">Dati Persona</h5>
                        <div class="form-group">
                            <label for="cf">Codice Fiscale<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="cf" id="cf" maxlength="16">
                            <p id="err_cf" class="req err-form"></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="cognome">Cognome<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="cognome" id="cognome" maxlength="60">
                            <p id="err_cog" class="req err-form"></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="nome">Nome<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="nome" id="nome" maxlength="60">
                            <p id="err_nome" class="req err-form"></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">email<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="email" name="email" id="email" maxlength="60">
                            <p id="err_email" class="req err-form"></p>
                        </div>

                        <div class="form-group">
                            <label for="cellulare">cellulare</label>
                            <input class="form-control form-control-sm dati-req" type="text" name="cellulare" id="cellulare" maxlength="60">
                            <p id="err_cellulare" class="req err-form"></p>
                        </div>

                        <div class="form-group">
                            <label for="materia_insegnamento">Materia insegnamento<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="materia_insegnamento" id="materia_insegnamento" maxlength="60">
                            <p id="err_materia_insegnamento" class="req err-form"></p>
                        </div>

                        <div class="form-group">
                            <label for="classe_concorso">Classe di Concorso (Per infanzia e primaria usare 00AA e 00EE)<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="classe_concorso" id="classe_concorso" maxlength="30">
                            <p id="err_classe_concorso" class="req err-form"></p>
                        </div>
                        
                        <p class="req mt-2">* Campo Obbligatorio</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mt-2">
                <div class="card">
                    <div class="card-body" id="dati-istituto">
                        <h5 class="card-title">Dati Istituto di appartenenza</h5>
                        <div class="form-group">
                            <label for="istituto">Denominazione Istituto<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="istituto" id="istituto" maxlength="60">
                            <p id="err_istituto" class="req err-form"></p>
                        </div>

                        <div class="form-group">
                            <label for="meccanografico">Codice Meccanografico<span class="req">*</span></label>
                            <input class="form-control form-control-sm dati-req" type="text" name="meccanografico" id="meccanografico" maxlength="11">
                            <p id="err_meccanografico" class="req err-form"></p>
                        </div>
                        
                        <p class="req">* Campo Obbligatorio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dati-corso">
        <div class="row mb-2 mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Corsi disponibili</h5>
                        
                        <div class="form-group">
                            <p class="text-danger">è possibile iscriversi a massimo 5 corsi
                            </p>
                            
                            <label for="corsi_disp">Selezionare il corso desiderato:<span class="req">*</span></label>
                            
                            <div id="elenco-corsi">
                                    
                            </div>
                            <div id="err-corsi-sel" class="alert alert-danger mt-2" role="alert">
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <div id="dati-conferma-isc" class="text-center">
        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Esito Iscrizione</h5>
                        <div class="form-group text-left" id="conferma-isc">
                            
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
            <a href="" class="btn btn-primary" id="btn-modifica">Modifica</a>
        </p>
    </div>

    
</form>
<script src="js/corsi/modifica-cancellazione.js?<?php echo filemtime("js/corsi/modifica-cancellazione.js"); ?>"></script>