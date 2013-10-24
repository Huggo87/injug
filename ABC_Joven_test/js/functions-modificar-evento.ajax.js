$(document).on('ready',inicio());

function inicio()
{
    var evnt = getUrlVars()["evento"];
    // console.log(mun);
    $.ajax({
            type:"POST",
            url:"../test.php",
            data:'caso=' + '49'+'&evnt='+evnt,
            success:function(evnt)
            {
                var datos = evnt.split('|');
                console.log(evnt);
                $('#up-nevento-input').val(datos[0]);
                if(datos[1]== 1)
                {
                    $('#up-edo').val(datos[1]);
                    //$('#up-edo').attr("selected",true);
                }
                else if(datos[1]== 0)
                {
                   $('#up-edo').val(datos[1]);
                    //$('#up-edo').attr("selected",true);
                }
                linea(datos[2]);
                estrategia(datos[3]);
                programa(datos[4]);
                tipo(datos[5])
                //edo(datos[1]);
            },
            error:function(mun)
            {
                //$("#usr-rol-input").html(mun);
                console.log(mun);
            }
    });
    $('#update-evnt').on('click',updevento);

}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function updevento()
{
    if($('#up-nevento-input').val()!='' && $("select").val()!='')
    {
        var evnt = getUrlVars()["evento"];
        $.ajax({
                type:"POST",
                url:"../test.php",
                data:'caso=' + '54'+'&id='+evnt+'&evento='+$('#up-nevento-input').val()+'&edo='+$('#up-edo').val()+'&linea='+$("#up-linea").val()+'&estrategia='+$("#up-est").val()+'&programa='+$("#up-pro").val()+'&tipo='+$("#up-tipo").val(),
                success:function(update)
                {
                    console.log(update);
                    if(update == '1')
                    {
                        $('#noti-evnt-update').html('Se ha actualizado el Evento.');
                    }
                    else
                        $('#noti-evnt-update').html('Error al actualizar.');
                },
                error:function(update)
                {
                    //$("#usr-rol-input").html(update);
                    console.log(update);
                }
        });
    }
    else
    {
        $('#noti-evnt-update').html('Deber ingresar los datos correctamente no campos vacios o sin seleccionar');
    }
}
function linea(linea)
{
    //console.log(linea);
    $.ajax({
        async: true,
        type: "POST",
        dataType:  "html",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        url: "../test.php",
        data: 'caso='+'50'+'&linea='+linea,//+ '&login_userpass=' + $('#password').val(),
        //beforeSend: funcion,
        
        success:function(linea){
            $("#up-linea").html(linea);
            //console.log(linea);
        },
        //timeout: 4000,
        error: function(linea){
            //console.log(linea);
        }
    });
}
function estrategia(estrg)
{
    //console.log(estrg);
    $.ajax({
        async: true,
        type: "POST",
        dataType:  "html",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        url: "../test.php",
        data: 'caso='+'51'+'&estrategia='+estrg,//+ '&login_userpass=' + $('#password').val(),
        //beforeSend: funcion,
        
        success:function(estrg){
            $("#up-est").html(estrg);
            //console.log(estrg);
        },
        //timeout: 4000,
        error: function(estrg){
            console.log(estrg);
        }
    });
}
function programa(prog)
{
    //console.log(prog);
    $.ajax({
        async: true,
        type: "POST",
        dataType:  "html",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        url: "../test.php",
        data: 'caso='+'52'+'&programa='+prog,//+ '&login_userpass=' + $('#password').val(),
        //beforeSend: funcion,
        
        success:function(prog){
            $("#up-pro").html(prog);
            //console.log(prog);
        },
        //timeout: 4000,
        error: function(prog){
            //console.log(prog);
        }
    });
}
function tipo(tipo)
{
    $.ajax({
        async: true,
        type: "POST",
        dataType:  "html",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        url: "../test.php",
        data: 'caso='+'53'+'&tipo='+tipo,//+ '&login_userpass=' + $('#password').val(),
        //beforeSend: funcion,
        
        success:function(tipo){
            $("#up-tipo").html(tipo);
            //console.log(tipo);
        },
        //timeout: 4000,
        error: function(tipo){
            //console.log(tipo);
        }
    });
}
