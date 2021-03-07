const state = Object.freeze({
    insCodice:1,
    errCanc:2,
    sceltaData:3,
    confermaApp:4
});

var statePage;
var idFasciaSel="";
var oraSel="";
var dataApp="";
var formatoData="";


function onLoadModAppuntamento()
{
    statePage=state.insCodice;
    $('#btn-prev').hide();
    $('#btn-conferma').hide();
    $('#dati-calendar').hide();
    $('#dati-fasce-orarie').hide();
    $('#dati-canc-mod').hide();
    $('#esito').hide();
    $('#btn-next').hide();
    $('#btn-home').show();
      
}

$('#btn-cerca').on('click',function(e)
    {
        $('#error').html("");
        e.preventDefault();
        if($('#codice').val()=="")
        {
            $('#error').html("Il campo codice è vuoto. Inserire un codice e cliccare su <b>Cerca</b>");
            return;
        }

        var dati=$('#codice').serialize();
        $.post('php/cercaApp.php',dati)
        .done(function(data)
            {
                $('#card-dati-canc-mod').html(data);
                $('#dati-canc-mod').show();
                $('#btn-home').hide();
            })
        .fail(function()
        {
            $('#error').html("Errore nel caricamento delle fasce orarie");
        }
        );

    }
);

$(document).on('click','#btn-canc',function(e)
    {
        e.preventDefault(); 
        var conferma=confirm("Vuoi confermare la cancellazione dell'appuntamento?");
        if(conferma)
        {
            var dati=$('#codice').serialize();
            $.post('php/cancApp.php',dati)
            .done(function(data)
                {
                    $('#esito-mod-canc').html(data);
                    $('#dati-appuntamento').hide();
                    $('#dati-canc-mod').hide();
                    $('#esito').show();
                    $('#btn-home').show();
                    $('#btn-prev').show();
                    statePage=state.errCanc;
                })
            .fail(function()
            {
                $('#error').html("Errore nella cancellazione dell'appuntamento");
            }
            );
        }
    }
);

$(document).on('click','#btn-mod',function(e)
    {
        e.preventDefault(); 
        $('#dati-calendar').show();
        $('#btn-prev').show();
        $('#btn-home').show();
        $('#dati-appuntamento').hide();
        $('#dati-canc-mod').hide();
        statePage=state.sceltaData;
    }
);



$('#btn-prev').on('click',function(e)
{
   e.preventDefault(); 
   if(statePage==state.errCanc)
   {
        
            $('#btn-prev').hide();
            $('#esito').hide();
            $('#btn-home').hide();
            $('#dati-appuntamento').show();
            statePage=state.insCodice;
            return;
    }
    if(statePage==state.sceltaData)
   {
        
            $('#btn-prev').hide();
            $('#btn-home').hide();
            $('#dati-calendar').hide();
            $('#dati-fasce-orarie').hide();
            $('#btn-conferma').hide();
            $('#dati-appuntamento').show();
            $('#btn-home').show();
            statePage=state.insCodice;
            return;
    }  
    if(statePage==state.confermaApp)
   {
        $('#dati-appuntamento').show();
        $('#esito').hide();
        $('#btn-conferma').hide();
        $('#btn-prev').hide();
        $('#btn-home').hide();
        $('#fasce-orarie').html("");
        $("#data_app").val("");
   }  
});

function visualizzaFasce()
{
    if($('#data_app').val()=="")
        {
            $('#error').html("Non è stata selezionata alcuna data");
            return;
        }
    $('#error').html("");
        var dateSplit = $("#data_app").val().split("-");
        var dataIns=""
        
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
        visualizzaFasce();
        idFasciaSel="";
        oraSel="";
    }
);

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


$('#btn-conferma').on('click',function(e)
    {
        e.preventDefault(); 
        var conferma=confirm("Vuoi confermare la nuova scelta: "+dataApp+" alle ore "+oraSel+"?");
        if(conferma)
        {
            var tmp= $('#data_app').val();
            if(formatoData=="it")
            {
                var dateSplit= dataApp.split("/");
                $('#data_app').val(dateSplit[2]+'-'+dateSplit[1]+'-'+dateSplit[0]);
            }

            var dati=$('#form-mod-app').serialize();
            dati+='\&id_fascia='+idFasciaSel;
            $.post('php/modApp.php',dati)
            .done(function(data)
                {
                    $('#esito-mod-canc').html(data);
                    $('#esito').show();
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