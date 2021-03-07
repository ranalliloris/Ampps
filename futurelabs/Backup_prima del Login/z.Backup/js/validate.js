var errormsg = {
'cf' : 'Codice Fiscale non corretto',
'email':'Formato Email non valido',
'cell':'Formato cellulare non valido',
'user':'l\'username non può iniziare con un numero o carattere speciale e deve essere composto da almeno due caratteri',
'password':'Le due password non coincidono',
'password-pattern':'La password deve essere di almeno 8 caratteri, deve contenere almeno una cifra, una maiuscola, una minuscola e un carattere speciale',
'campoVuoto':'Questo campo non può essere vuoto'
};

$("#cf").on('change',function(e)
{
    var patt=/^[a-zA-Z]+[a-zA-Z0-9]{15}/;
    if(!patt.test($("#cf").val()))
    {
        $("#err_cf").html(errormsg["cf"]);
    }
    else
    {
        $("#err_cf").html("");
    }
}
);

$("#username").on('change',function(e)
{
    var patt=/^[a-zA-Z]+[a-zA-Z0-9]/;
    if(!patt.test($("#username").val()))
    {
        $("#err_username").html(errormsg["user"]);
    }
    else
    {
        $("#err_username").html("");
    }
}
);

$("#email").on('change',function(e)
{
    var patt=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if(!patt.test($("#email").val()))
    {
        $("#err_email").html(errormsg["email"]);
    }
    else
    {
        $("#err_email").html("");
    }
}
);

$("#cellulare").on('change',function(e)
{
    var patt=/^([0-9\+]+)([0-9\-\/]{1,15})$/;
    if(!patt.test($("#cellulare").val()))
    {
        $("#err_cell").html(errormsg["cell"]);
    }
    else
    {
        $("#err_cell").html("");
    }
}
);
$("#password").on('change',function(e)
{
    var pwd=$("#password").val();
    var pwdPattern=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    if(!pwd.match(pwdPattern)) 
    { 
        $("#err_password").html(errormsg["password-pattern"]);
    }
    else
    {
        $("#err_password").html("");
    }
}
);
$("#re-password").on('change',function(e)
{
    if($("#password").val()!=$("#re-password").val())
        $("#err_password").html(errormsg["password"]);
    else
        $("#err_password").html("");
}
);

$("#btn-clear").on('click',function(e)
{
    e.preventDefault();
    $("#cognome").val("");
    $("#nome").val("");
    $("#email").val("");
    $("#username").val("");
    $("#password").val("");
    $("#re-password").val("");
}
);

function controllaCampiDiv(arrayEl)
{
    var err=true; //Validazione true di default, cambia quando c'è almeno un campo vuoto
    for(i=0;i<arrayEl.length;i++)
    {
        if(arrayEl[i].value=="")
        {
            var idErr="#err_"+arrayEl[i].id;
            $(idErr).html(errormsg["campoVuoto"]);
            err=false;
        }
    }
    return err;
}