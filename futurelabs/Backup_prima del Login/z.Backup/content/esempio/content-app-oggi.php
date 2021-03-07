
        <div id="dati-ricerca">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Appuntamenti del <?php echo (new DateTime())->format("d-m-Y") ?> </h5>
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