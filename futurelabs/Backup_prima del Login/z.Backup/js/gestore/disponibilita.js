var tipoIns=null; //Segnala al php di inserimento la tipologia di operazione (insert, update)
var formatoData;
var dataSelezionata;
/*function loadDisponibilita()
{
    var today=new Date();
    var d=""+today.getDate();
    var m=""+(today.getMonth()+1);
    var y=""+today.getFullYear();
    
    d=(d.length==1)?'0'+d:d;
    
    m=(m.length==1)?'0'+m:m;
    $("#disp-title").html("Disponibilità del "+today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear());
    $("#data-disp").val(y+"-"+m+"-"+d);

    var dati=$('#form-disp').serialize();
    $.post('php/gestore/view-disp.php',dati)
    .done(function(data)
        {
            $('#dati-disponibilità').html(data);
        })
    .fail(function()
    {
        $('#error').html("Errore nel caricamento delle disponibilità");
    }
    );
}*/

/*********************************
 * RICORDATI DEL PROBLEMA SE SI CAMBIA LA DATA E SI PREME SU SALVA CON UNA TABELLA DI UN'ALTRA DATA
 */

function loadDisponibilita()
{
    $("#btn-salva-disp").show();
    var today=new Date();
    var d=""+today.getDate();
    var m=""+(today.getMonth()+1);
    var y=""+today.getFullYear();
    
    d=(d.length==1)?'0'+d:d;
    
    m=(m.length==1)?'0'+m:m;
    $("#disp-title").html("Disponibilità del "+today.getDate()+"/"+(today.getMonth()+1)+"/"+today.getFullYear());
    $("#data-disp").val(y+"-"+m+"-"+d);
    dataSelezionata=$("#data-disp").val();
    var dati=$('#form-disp').serialize();
    $.ajax({
        url: 'php/gestore/view-disp.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                tipoIns=dataObj.typeIns;
                $('#card-dati-disponibilità').html(dataObj.html);
            }
            else
            {
                $('#card-dati-disponibilità').html(dataObj.html);
            }
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });
}

$('#btn-cerca-data').on('click', function(e)
{
    $('#error').html("");
    $('#card-dati-disponibilità').html("");
    $("#btn-salva-disp").show();
    tipoIns=null;


    if($('#data-disp').val()=="")
    {
        $('#error').html("Non è stata selezionata alcuna data");
        return;
    }
    var linechar=$("#data-disp").val().indexOf('-');
    if(linechar!=-1)
        var dateSplit = $("#data-disp").val().split("-");
    else
        var dateSplit = $("#data-disp").val().split("/");
    var dataIns="";
    
    if(dateSplit[0]>=2020)
    {
        dataIns=new Date(dateSplit[0], dateSplit[1] - 1, dateSplit[2]);
    }
    else if(dateSplit[2]>=2020)
    {
        dataIns=new Date(dateSplit[2], dateSplit[1] - 1, dateSplit[0]);
    }
    else
    {
        $('#error').html("Data Non Valida!");
        return;
    }

    var d=""+dataIns.getDate();
    var m=""+(dataIns.getMonth()+1);
    var y=""+dataIns.getFullYear();
    
    d=(d.length==1)?'0'+d:d;
    m=(m.length==1)?'0'+m:m;

    $("#disp-title").html("Disponibilità del "+d+"/"+m+"/"+y);
    $("#data-disp").val(y+"-"+m+"-"+d);
    dataSelezionata=$("#data-disp").val();
    var dati=$('#form-disp').serialize();
    $.ajax({
        url: 'php/gestore/view-disp.php',
        type: 'post',
        data: dati,
        success: function(data){
            var dataObj= JSON.parse(data);
            if(dataObj.esito=="success")
            {
                tipoIns=dataObj.typeIns;
                $('#card-dati-disponibilità').html(dataObj.html);
            }
            else
            {
                $('#card-dati-disponibilità').html(dataObj.html);
            }
            
        },
        error:function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        }
    });
    

});

$('#btn-salva-disp').on('click', function(e)
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