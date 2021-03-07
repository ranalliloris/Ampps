function onLoadRegistraUtente()
{
    $('#btn-home').hide();
    $('#dati-conferma-reg').hide();
    $('#error').html("");
    var dati=$('#plesso').serialize();
        $.post('php/classiPlesso.php',dati)
        .done(function(data)
            {
                $('#classe').html(data);
            })
        .fail(function()
        {
            $('#error').html("Errore nell'elenco delle classi");
        }
        );       
}

$('#plesso').on('change',function(e)
    {
        e.preventDefault();           
        var dati=$('#plesso').serialize();
        $.post('php/classiPlesso.php',dati)
        .done(function(data)
            {
                $('#classe').html(data);
            })
        .fail(function()
        {
            $('#error').html("Errore nell'elenco delle classi");
        }
        );       
    }
);

function checkInput()
{
    var msgErr="Sono stati rilevati i seguenti errori:";
    var err=false;
    if($('#cognome').val()=="")
    {
        msgErr+="<br>Cognome mancante";
        err=true;
    }
    if($('#nome').val()=="")
    {
        msgErr+="<br>Nome mancante";
        err=true;
    }
    if($('#password').val()=="" || $('#re-password').val()=="")
    {
        msgErr+="<br>Password mancante";
        err=true;
    }
    console.log("Plesso:"+$('#plesso').val());
    if($('#plesso').val()=="")
    {
        msgErr+="<br>Plesso mancante";
        err=true;
    }
    //Il codice in basso serve a reperire la classe generata dinamicamente
    var e = document.getElementById("classe");
    var valClasse = "";
    if(e.selectedIndex>=0)  //controllo se l'indice attualmente selezionato è >=0, è -1 quando non ci sono opzioni selezionate
    {
        valClasse = e.options[e.selectedIndex].value;
    }
    console.log("Classe:"+valClasse);
    if(valClasse=="")
    {
        msgErr+="<br>Classe mancante";
        err=true;
    }
    
    if(err)
    {
        $('#error').html(msgErr);
        return false;
    }
    return true;
}

$('#btn-registra-stud').on('click',function(e)
    {
        $('#error').html("");
        e.preventDefault();           
        var dati=$('#form-registra-utente').serialize();
        dati+='\&ruolo=studente';
        if(!checkInput())
        {
            return;
        }
        $.ajax({
            url: 'php/registra-utente.php',
            type: 'post',
            data: dati,
            success: function(data){
                var dataObj= JSON.parse(data);
                if(dataObj.esito=="studente_notverify")
                {
                    $('#error').html(dataObj.esitohtml);
                    return;
                }
                if(dataObj.esito=="studente_verify")
                {
                    $('#conferma-reg').html(dataObj.esitohtml);
                    $('#dati-conferma-reg').show();
                    $('#form-registra-utente').hide();
                    $('#btn-home').show();
                    return;
                }
                if(dataObj.esito=="error")
                {
                    console.log(dataObj.message);
                    return; 
                }
            },
            error:function( jqXHR, textStatus ) {
                alert( "Request failed: " + textStatus );
              }
        });

        /*
        .done(function(data)
            {
                $('#conferma-reg').html(data);
                $('#dati-conferma-reg').show();
                $('#form-registra-utente').hide();
                $('#btn-home').show();
            })
        .fail(function()
        {
            $('#error').html("Errore nella registrazione dell'utente");
        }
        );*/       
    }
);

/*
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
});*/