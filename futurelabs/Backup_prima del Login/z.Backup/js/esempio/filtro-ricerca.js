var csv="";

function onLoadAppOggi()
{
    var today=new Date()
    var dati="data-app="+today.getFullYear()+"-"+(today.getMonth()+1)+"-"+today.getDate();
    $.post('php/cerca-app-data.php',dati)
        .done(function(data)
            {
                $('#card-dati-ricerca').html(data);
            })
        .fail(function()
        {
            $('#error').html("Errore visualizzazione dei risultati");
        }
        );
}



$('#btn-cerca-data').on('click',function(e)
{
    e.preventDefault();
    $('#error').html("");
    if($('#data-app').val()=="")
    {
        $('#error').html("<br>- Non hai inserito nessuna data");
        return;
    }

    var dati=$('#form-ricerca').serialize();
    $.post('php/cerca-app-data.php',dati)
        .done(function(data)
            {
                $('#card-dati-ricerca').html(data);
            })
        .fail(function()
        {
            $('#error').html("Errore visualizzazione dei risultati");
        }
        );
}
);

$('#btn-cerca-cognome').on('click',function(e)
{
    e.preventDefault();
    $('#error').html("");
    if($('#cognome').val()=="")
    {
        $('#error').html("<br>- Non hai inserito il cognome da cercare");
        return;
    }

    var dati=$('#form-ricerca').serialize();
    $.post('php/cerca-app-cognome.php',dati)
        .done(function(data)
            {
                $('#card-dati-ricerca').html(data);
            })
        .fail(function()
        {
            $('#error').html("Errore visualizzazione dei risultati");
        }
        );
}
);


function download(filename, text) {
    const element = document.createElement("a");
    element.setAttribute("href", "data:text/csv;charset=utf-8,\ufeff" + encodeURIComponent(text));
    element.setAttribute("download", filename);

    element.style.display = "none";
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}

$('#btn-csv').on('click',function(e)
{
    e.preventDefault();
    download("table.csv",csv);
    
});


$('#btn-canc').on('click',function(e)
{
    e.preventDefault();
    $('#card-dati-ricerca').html("");
    $('#data-from').val("");
    $('#data-to').val("");
});


$('#btn-cerca-date-range').on('click',function(e)
{
    e.preventDefault();
    $('#error').html("");
    if($('#data-from').val()=="" && $('#data-to').val()=="")
    {
        $('#error').html("<br>- I campi delle date sono vuoti. E' necessario inserire almeno una data nell'intervallo");
        return;
    }

    var dati=$('#form-ricerca').serialize();
    $.post('php/cerca-app-range-date.php',dati)
        .done(function(data)
            {
                $('#card-dati-ricerca').html(data);
                var tab=document.getElementById( "tab-app" );
                tab=$(tab);
                let options = {
                "separator": ";",
                "newline": "\n",
                "quoteFields": false,
                "excludeColumns": "",
                "excludeRows": "",
                "trimContent": true,
                "filename": "table.csv",
                "appendTo": "#output"
                }
                
                csv=tab.table2csv('return', options);

                $('#tab-app').DataTable();
            })
        .fail(function()
        {
            $('#error').html("Errore visualizzazione dei risultati");
        }
        );
}
);