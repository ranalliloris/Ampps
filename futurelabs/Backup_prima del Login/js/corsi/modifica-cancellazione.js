
var nCorsiSel=0;
var numMaxCorsiSel=5;
window.addEventListener('load',pageLoad,false);

function pageLoad(e)
{
    $('#dati-conferma-isc').hide();
    $('#err-corsi-sel').hide();
    $('#dati-corso').hide();
    $('#dati-utente').hide();
    $('#btn-modifica').hide() /***** NASCONDO IL BOTTONE MOMENTANEAMENTE */
    dati="";
    $.ajax({
        url: 'php/corsi/elenco-corsi.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                $('#elenco-corsi').html(dataObj.html);
            }
            else if(dataObj.esito=="err_debug")
            {
                console.log(dataObj.html);
            }
            else
            {
                $('#error').html(dataObj.html);
            }
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });  
    nCorsiSel=0;
}

function caricaDatiPersona (datiP)
{
        var elInput=document.querySelectorAll("#dati-utente input");
        for(var i=0; i<elInput.length;i++)
        {
            if(elInput[i].id!="codice_iscrizione")
            {
                elInput[i].value=datiP[elInput[i].id];
            }
        }
}

function caricaDatiCorsi(datiC)
{
    if(datiC!==null)
    {
        var corsi=Object.keys(datiC); //Restituisce le proprietà dell'oggetto Object
        for(var i=0;i<corsi.length;i++)
        {
            $('#'+corsi[i]).prop( "checked", true );
            if($('#'+corsi[i]).prop( "disabled"))
            {
                $('#'+corsi[i]).prop( "disabled",false);
            }
        }
    }

}

$('#btn-cerca').on('click', function(e)
{
  
    e.preventDefault();
    $('#error').html("");
    dati="";
    var dati=$('#form-modifica').serialize();
    $.ajax({
        url: 'php/corsi/load_modifica.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                $('#dati-corso').show();
                $('#dati-utente').show();
                caricaDatiPersona(dataObj.datiP);
                caricaDatiCorsi(dataObj.datiC);
                $('#elenco-corsi').html(dataObj.html);
            }
            else if(dataObj.esito=="err_debug")
            {
                console.log(dataObj.html);
            }
            else
            {
                $('#error').html(dataObj.html);
            }
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });
});

$(document).on('click','.corsi-fl',function(e)
{
    
    var corso=e.target;
    if(corso.checked==true)
    {
        nCorsiSel++;
    }
    else
    {
        nCorsiSel--;
    }
    if(nCorsiSel>numMaxCorsiSel)
    {
        $('#err-corsi-sel').show();
        $('#err-corsi-sel').html("ERRORE! Hai selezionato più di "+numMaxCorsiSel+" corsi");
    }
    else
    {
        $('#err-corsi-sel').hide();
    }
}
);



$('#btn-iscriviti').on('click', function(e)
{
    e.preventDefault();
    if(nCorsiSel==0)
    {
        $('#err-corsi-sel').html("ERRORE! Non Hai selezionato nessun corso");
        return
    }
    
    $('#error').html("");
    $('#conferma-isc').html("");
    e.preventDefault();
    var campiInput=document.getElementsByClassName("dati-req");
    var check=controllaCampiDiv(campiInput);
    if(check==true && nCorsiSel<=numMaxCorsiSel) //Se i campi sono validi
    {
        var dati=$('#form-iscrizione').serialize();
    $.ajax({
        url: 'php/corsi/iscrizione.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                $('#dati-conferma-isc').show();
                $('#conferma-isc').html(dataObj.html);
                $('#btn-iscriviti').hide();
            }
            else if(dataObj.esito=="err_debug")
            {
                console.log(dataObj.html);
            }
            else
            {
                $('#error').html(dataObj.html);
            }
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });
    }

}
);