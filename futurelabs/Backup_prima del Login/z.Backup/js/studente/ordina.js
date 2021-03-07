var tipoIns=null; //Segnala al php di inserimento la tipologia di operazione (insert, update)
var formatoData;
const timeRangeOrd = Object.freeze({
    min:11,
    max:23
});
var msgAlert="E' possibile prenotare panini e/o bevande dalle "+timeRangeOrd.min+":00 alle "+timeRangeOrd.max+":00 del giorno precedente";
function loadListino()
{
    $('#error').html("");
    $('#dati-listino').show();
    $("#btn-ord").show();
    $("#ord-alert").html(msgAlert);
    var dayOrd=new Date();
    var d="";
    if(dayOrd.getDay()==6)
        d=""+(dayOrd.getDate()+2); //Se è sabato vado al lunedì
    else
        d=""+(dayOrd.getDate()+1);
    var m=""+(dayOrd.getMonth()+1);
    var y=""+dayOrd.getFullYear();
    var h=dayOrd.getHours();

    if(h<timeRangeOrd.min || h>=timeRangeOrd.max)
    {
        $('#dati-listino').hide();
        $('#btn-ord').hide();
        $('#error').html("Non è possibile effettuare l'ordinazione. Le prenotazioni sono aperte dalle "+timeRangeOrd.min+":00 alle "+timeRangeOrd.max+":00 del giorno precedente");
        return;
    }
    d=(d.length==1)?'0'+d:d;
    
    m=(m.length==1)?'0'+m:m;
    $("#disp-title").html("Prenotazione del "+d+"/"+m+"/"+y);
    var dataOrd=""+y+"-"+m+"-"+d;
    var dati=$('#form-ord').serialize();
    dati+='\&dataOrd='+dataOrd;
    $.ajax({
        url: 'php/studente/view-listino.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                tipoIns=dataObj.typeIns;
                $('#card-dati-listino').html(dataObj.html);
            }
            else if(dataObj.esito=="err_debug")
            {
                console.log(dataObj.html);
            }
            else
            {
                $('#btn-ord').hide();
                $('#card-dati-listino').html(dataObj.html);
            }
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });
}

$('#btn-ord').on('click', function(e)
{
    e.preventDefault();
    $('#error').html("");
    $('#dati-listino').show();
    var panini=document.getElementsByClassName('panino');
    var pizze=document.getElementsByClassName('pizza');
    var bevande=document.getElementsByClassName('bevanda');
    var nPanPiz=0;
    var nBevande=0;
    for(var i=0; i<panini.length;i++)
    {
        nPanPiz+=parseInt(panini.item(i).value);
    }
    for(var i=0; i<pizze.length;i++)
    {
        nPanPiz+=parseInt(pizze.item(i).value);
    }
    for(var i=0; i<bevande.length;i++)
    {
        nBevande+=parseInt(bevande.item(i).value);
    }
    if(nPanPiz>3 || nBevande>3)
    {
        $('#error').html("Non puoi ordinare più di 3 panini/pizze e/o più di 3 bevande.<br>Pizze/Panini: "+nPanPiz+"<br>Bevande: "+nBevande);
    }


    var dayOrd=new Date();
    var d="";
    if(dayOrd.getDay()==6)
        d=""+(dayOrd.getDate()+2); //Se è sabato vado al lunedì
    else
        d=""+(dayOrd.getDate()+1);
    var m=""+(dayOrd.getMonth()+1);
    var y=""+dayOrd.getFullYear();
    var h=dayOrd.getHours();

    if(h<timeRangeOrd.min || h>=timeRangeOrd.max)
    {
        $('#dati-listino').hide();
        $('#error').html("Non è possibile effettuare l'ordinazione. Le prenotazioni sono aperte dalle "+timeRangeOrd.min+":00 alle "+timeRangeOrd.max+":00 del giorno precedente");
        return;
    }
    d=(d.length==1)?'0'+d:d;
    m=(m.length==1)?'0'+m:m;
    var dataOrd=""+y+"-"+m+"-"+d;

    var dati=$('#form-ord').serialize();
    dati+='\&dataOrd='+dataOrd;
    $.ajax({
        url: 'php/studente/ordina.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                $('#card-dati-esito').html(dataObj.html);
                $('#card-dati-listino').hide();
                $('#btn-ord').hide();
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

/*$('#btn-salva-disp').on('click', function(e)
{
    e.preventDefault();
    $('#error').html("");
    if($("#data-disp").val()!=dataSelezionata)
    {
        $('#error').html('<p class="req">La data selezionata è diversa dalla quella inserita nella casella di testo</p>');
        return; 
    }
    var dati=$('#form-disp').serialize();
    dati+='\&insType='+tipoIns;

    $.ajax({
        url: 'php/gestore/insert-disp.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            $('#card-dati-disponibilità').html(dataObj.html);
            $("#btn-salva-disp").hide();
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });   
    
}
);
*/