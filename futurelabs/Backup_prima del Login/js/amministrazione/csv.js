var csv;
window.addEventListener('load',pageLoad,false);

function pageLoad(e)
{
    e.preventDefault();

    
    var dati="";
    $.post('php/download_csv_iscrizioni.php',dati)
        .done(function(data)
            {
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

$('#btn-csv').on('click',function(e)
{
    e.preventDefault();
    download("table.csv",csv);
    
});

function download(filename, text) {
    const element = document.createElement("a");
    element.setAttribute("href", "data:text/csv;charset=utf-8,\ufeff" + encodeURIComponent(text));
    element.setAttribute("download", filename);

    element.style.display = "none";
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}
