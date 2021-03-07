//Gestione Login
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
                if(dataObj.ruolo=="studente")
                {
                    location.href='./controller.php?path=studente&service=content-index-studente.php';    
                }
                else if (dataObj.ruolo=="scuola")
                {
                    location.href='./controller.php?path=scuola&service=content-index-scuola.php';    
                }
                else if (dataObj.ruolo=="gestore")
                {
                    location.href='./controller.php?path=gestore&service=content-index-gestore.php';    
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