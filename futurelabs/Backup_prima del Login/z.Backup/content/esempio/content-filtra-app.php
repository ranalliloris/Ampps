<form id="form-ricerca">
    
    <div class="row">
            <div class="input-group mb-3 col-md-5">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data</span>
                </div>
                    <input type="date" class="form-control" id="data-app" name="data-app">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btn-cerca-data">Cerca</button>
                </div>
            </div>
            <div class="input-group mb-3 col-md-5">
                <div class="input-group-prepend">
                    <span class="input-group-text">Cognome</span>
                </div>
                    <input type="text" class="form-control" id="cognome" name="cognome">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btn-cerca-cognome">Cerca</button>
                </div>
            </div>
    </div>
 
        <div id="dati-ricerca">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dati Appuntamento</h5>
                            <div id="card-dati-ricerca">
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

    <div id="error-cmdline" class="d-print-none">
        <p class="req" id="error"></p>
        <p class="text-center" id="pulsanti">
            <a href="index.php" class="btn btn-primary" id="btn-home">Torna alla Home</a>
            <a href="" class="btn btn-primary" id="btn-csv">Scarica CSV</a>
        </p>
    </div>

    
</form>