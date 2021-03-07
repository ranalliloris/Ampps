const state = Object.freeze({
    anagrafica:1,
    sceltaData:2,
    confermaApp:3
});

const date = Object.freeze(
    {
        dataInizio:"2020-06-29",
        dataFine:"2020-07-07"
    }
    
);

var statePage;
var idFasciaSel="";
var oraSel="";
var dataApp="";
var formatoData="";

function onLoadAppuntamento()
{
    statePage=state.anagrafica;
    
    $('#btn-prev').hide();
    $('#btn-conferma').hide();
    $('#dati-calendar').hide();
    $('#dati-fasce-orarie').hide();
    $('#dati-conferma-app').hide();
    $('.err-form').html("");
    idFasciaSel="";
    var oraSel="";
}


function aggiornaFasce()
{
    if($('#data_app').val()=="")
    {
        return;
    }
    visualizzaFasce();
}



function anagraficaValidate()
{
    var strErr="Sono stati rilevati i seguenti errori:";
    var err=false;
    if($('#cf_stud').val()=="")
   {
       strErr+="<br>- Codice Fiscale Studente Mancante";
       err=true;
   }
   if($('#cognome_stud').val()=="")
   {
       strErr+="<br>- Cognome Studente Mancante";
       err=true;
   }
   if($('#nome_stud').val()=="")
   {
       strErr+="<br>- Nome Studente Mancante";
       err=true;
   }
   if($('#cognome_gen').val()=="")
   {
       strErr+="<br>- Cognome Genitore Mancante";
       err=true;
   }
   if($('#nome_gen').val()=="")
   {
       strErr+="<br>- Nome Genitore Mancante";
       err=true;
   }
   if($('#email').val()=="")
   {
       strErr+="<br>- Email Mancante";
       err=true;
   }
   if($('#cellulare').val()=="")
   {
       strErr+="<br>- Cellulare Mancante";
       err=true;
   }
   if(err)
   {
       $('#error').html(strErr);
       return false;
   }
   return true;
}


$(document).on('click','.fasciabtn',function(e)
{
    $('#btn-conferma').show();
    e.preventDefault(); 
    var a=e.target; //memorizzo il riferimento all'elemento cliccato
    if(idFasciaSel=="")
    {
        idFasciaSel=$(a).attr('id'); //memorizzo l'id dell'elemento cliccato
        oraSel=$(a).text();
        $(a).removeClass("btn-success");
        $(a).addClass("btn-primary");
    }
    else if(idFasciaSel==$(a).attr('id')) //Se è già cliccato lo deseleziono
    {
        idFasciaSel=""; //memorizzo l'id dell'elemento cliccato
        oraSel="";
        $(a).removeClass("btn-primary");
        $(a).addClass("btn-success");
        $('#btn-conferma').hide();
    }
    else
    {
        $(a).removeClass("btn-success");
        $(a).addClass("btn-primary");
        if($('#'+idFasciaSel)!=undefined)
        {
            $('#'+idFasciaSel).removeClass("btn-primary");
            $('#'+idFasciaSel).addClass("btn-success");
        }
        idFasciaSel=$(a).attr('id');
        oraSel=$(a).text();
    }


});


$('#btn-next').on('click',function(e)
{
   e.preventDefault(); 
   if(statePage==state.anagrafica)
   {
        validate=anagraficaValidate();
        if(validate)
        {
            $('#dati-utente').hide();
            $('#dati-calendar').show();
            $('#btn-prev').show();
            statePage=state.sceltaData;
            $('#error').html("");
            if($('#data_app').val()!="")
            {
                $('#dati-fasce-orarie').show();
            }
            $('#btn-next').hide();          
        }
    } 
    return;

});

$('#btn-prev').on('click',function(e)
{
   e.preventDefault(); 
   if(statePage==state.anagrafica)
   {
        
            $('#btn-prev').hide();
            return;
    } 
    if(statePage==state.sceltaData)
    {
        $('#dati-utente').show();
        $('#dati-calendar').hide();
        $('#btn-prev').hide();
        $('#btn-conferma').hide();
        $('#dati-fasce-orarie').hide();  
        statePage=state.anagrafica;
        $('#btn-next').show();  
    }
    if(statePage==state.confermaApp)
    {
        statePage=state.sceltaData;
        $('#btn-conferma').show();
        $('#dati-utente').hide();
        $('#dati-calendar').show();
        $('#dati-fasce-orarie').hide();
        $('#dati-conferma-app').hide();
        $("#data_app").val("");

    }

});

$('#btn-conferma').on('click',function(e)
    {
        e.preventDefault(); 
        var conferma=confirm("Vuoi confermare l'appuntamento del "+dataApp+" alle ore "+oraSel+"?");
        if(conferma)
        {
            
            var tmp= $('#data_app').val();
            if(formatoData=="it")
            {
                var dateSplit= dataApp.split("/");
                $('#data_app').val(dateSplit[2]+'-'+dateSplit[1]+'-'+dateSplit[0]);
            }
            
            var dati=$('#form-app').serialize();
            dati+='\&id_fascia='+idFasciaSel;
            $('#data_app').val(tmp);
            $.post('php/confermaApp.php',dati)
            .done(function(data)
                {
                    $('#conferma-app').html(data);
                    $('#dati-conferma-app').show();
                    $('#dati-calendar').hide();
                    $('#dati-fasce-orarie').hide();
                    $('#btn-conferma').hide();
                    statePage=state.confermaApp;
                })
            .fail(function()
            {
                $('#error').html("Errore nel caricamento delle fasce orarie");
            }
            );
        }        
    }
);

function visualizzaFasce()
{
    $('#error').html("");
        
    if($('#data_app').val()=="")
    {
        $('#error').html("Non è stata selezionata alcuna data");
        return;
    }
    var dateSplit = $("#data_app").val().split("-");
    var dataIns="";
    
    if(dateSplit[0]>=2020)
    {
        dataIns=new Date(dateSplit[0], dateSplit[1] - 1, dateSplit[2]);
        formatoData="us";
    }
    else if(dateSplit[2]>=2020)
    {
        dataIns=new Date(dateSplit[2], dateSplit[1] - 1, dateSplit[0]);
        formatoData="it";
    }
    else
    {
        $('#error').html("Data Non Valida!");
        return;
    }
    
    var today=new Date();
    var giornoSett=dataIns.getDay();
    $('#dati-fasce-orarie').hide(); 
    

    if(today.toDateString()==dataIns.toDateString())
    {
        var ora=today.getHours();
        if(ora>=7)
        {
            $('#error').html("La prenotazione può essere fatta entro le 8:00 dell'giorno scelto"); 
            return;
        }
    }

    
    if(today.getFullYear()==dataIns.getFullYear())
    {
        if(dataIns.getMonth()-1<today.getMonth()-1)
        {
            $('#error').html("Non si può prenotare un appuntamento in un mese precedente");
            return;
        } 
        else if(today.getMonth()==dataIns.getMonth() && today.getDate()>dataIns.getDate())
        {
            $('#error').html("Non si può prenotare un appuntamento in una data passata");
            return;
        }
    }
    else if(today.getFullYear()>dataIns.getFullYear())
    {
        $('#error').html("Non si può prenotare un appuntamento in un data passata");
        return;
    }
    
    if(giornoSett==0)
    {
        $('#error').html("La data scelta è un giorno festivo oppure non ha posti disponibili");
        return;
    }
        
    dataApp=dataIns.getDate()+"/"+(dataIns.getMonth()+1)+"/"+dataIns.getFullYear();
    
    var tmp=$('#data_app').val();
    if(formatoData=="it")
    {
        $('#data_app').val(""+dateSplit[2]+"-"+dateSplit[1]+"-"+dateSplit[0]);
    }
    var dati=$('#data_app').serialize();
    $('#data_app').val(tmp);
    if(giornoSett!=3 && giornoSett!=4)
    {
        dati+='\&meridian=am';
    }
    $.post('php/fasceLibere.php',dati)
    .done(function(data)
        {
            $('#fasce-orarie').html(data);
            $('#dati-fasce-orarie').show();
        })
    .fail(function()
    {
        $('#error').html("Errore nel caricamento delle fasce orarie");
    }
    );
}

$('#data_app').on('change',function(e)
    {
        e.preventDefault();
        //window.setInterval(aggiornaFasce,30000);
        visualizzaFasce();
        idFasciaSel="";
        oraSel="";
    }
);

$('btn-cerca-data').on('click',function(e)
{
    e.preventDefault();
    visualizzaFasce();
    idFasciaSel="";
    oraSel="";
}
);

//Gestione Login Segreteria
$('#btn-login').on('click',function(e)
    {
        
        e.preventDefault();
        var err=false;
        var email=$('#username').val();
        if($('#username').val()=="")
        {
            strErr+="<br>- Non hai compilato il campo username";
            err=true;
        }
        if($('#password').val()=="")
        {
            strErr+="<br>- Non hai compilato il campo Password";
            err=true;
        }
        if(err)
        {
            $('#error').html(strErr);
                return false;
        }


        var dati=$('#form-login').serialize();
        $.ajax({
            url: 'php/login.php',
            type: 'post',
            data: dati,
            success: function(data){
                var dataObj= JSON.parse(data);
                if(dataObj.esito=="username_notverify")
                {
                    alert("Username errata. Si prega di riprovare");
                    return;
                }
                if(dataObj.esito=="password_notverify")
                {
                    alert("Password errata. Si prega di riprovare.");
                    return;
                }
                if(dataObj.esito=="error")
                {
                    alert(dataObj.message);
                    return; 
                }
                //[TMP-ODO] - controllo segreteria app odo
                if(dataObj.ruolo=="seg_odo")
                {
                    location.href='odontotecnici/index.php';    
                }
                else
                    location.href='index.php';
            },
            error:function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
              }
        });
    }
);