    <form id="form-ord">
        
        
            <div id="ord-alert" class="alert alert-warning" role="alert">
                
            </div>
        
    
            <div id="dati-listino">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="disp-title"></h5>
                                <div id="card-dati-listino">
                                
                                </div>
                                <div id="card-dati-esito">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            
        <div id="error-cmdline" class="d-print-none">
            <p class="req" id="error"></p>
            <p class="text-center" id="pulsanti">
                <a href="./controller.php?path=studente&service=content-index-studente.php" class="btn btn-primary" id="btn-home">Torna alla Home</a>
                <a href="" class="btn btn-primary" id="btn-ord">Ordina</a> 
            </p>
        </div>

        
    </form>
<script onload="loadListino()" src="js/studente/ordina.js?<?php echo filemtime("js/studente/ordina.js"); ?>"></script>