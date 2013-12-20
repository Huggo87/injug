$(document).on('ready',inicio());

function inicio()
{
	var anio = new Date();
	$( "#datepicker5" ).datepicker({
			changeYear: true,
			changeMonth: true ,
			closeText: 'Cerrar',
			prevText: '&#x3c;Ant',
			nextText: 'Sig&#x3e;',
			currentText: 'Hoy',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
			'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
			'Jul','Ago','Sep','Oct','Nov','Dic'],
			dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
			dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
			weekHeader: 'Sm',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			showCurrentAtPos: 0,
			yearRange: "1950:"+ anio.getFullYear(),
			onSelect: function(dateText, inst) { 
			      //var dateAsString = dateText; //the first parameter of this function
			      var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
			      //alert( $("#datepicker").datepicker( 'getDate' ) )
			      var fechaActual = new Date();
			      var anioActual = fechaActual.getFullYear();
			      var mesActual = fechaActual.getMonth()+1;
			      var diaActual = fechaActual.getDate();
			     // alert(anioActual+' '+mesActual+' '+diaActual);
			     // alert(dateAsObject.getFullYear() +' '+ (dateAsObject.getMonth()+1) +' '+ dateAsObject.getDate() );
			     if(dateAsObject.getFullYear() > anioActual )
			     {
			     	$('#datepicker1').val(' ');
			     	alert('Año mayor al actual');
			     }
			     else if(dateAsObject.getFullYear() == anioActual)
			     {
			     	if((dateAsObject.getMonth()+1) > mesActual)
			     	{
			     		$('#datepicker1').val(' ');
			     		alert('Mes seleccionado es mayor al actual');
			     	}
			     	else if((dateAsObject.getMonth()+1) == mesActual)
			     	{
			     		if(dateAsObject.getDate()>diaActual)
			     		{
			     			$('#datepicker1').val(' ');
			     			alert('Dia mayor al dia de hoy');
			     		}
			     	}
			     }
	}});$.datepicker.setDefaults($.datepicker.regional['es']);
	var user = getUrlVars()["user"];
	// console.log(user);
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '33'+'&user='+user,
			success:function(user)
			{
				$("#page-datail").html(user);
				//console.log(user)
				
			},
			error:function(user)
			{
				//$("#usr-rol-input").html(mun);
				console.log(user)
				
			}
	});
	$('#page-datail').on('click', 'input[type="submit"]', update_user);
	$('#page-datail' ).on('click', 'a', update_password);

}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function update_user()
{
	console.log(':)');
	var user = getUrlVars()["user"];
	// console.log($('#nom').val()+ user);
	$("#noti").html('');
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '34'+'&user='+user+ '&res='+$('#res-user-up').val()+ '&username='+$('#nomuser-user-up').val()+ '&nombre='+$('#nom-user-up').val()+ '&ap='+$('#ap-user-up').val()+ '&am='+$('#am-user-up').val()+ '&genero='+$('input[name="genero-user-up"]:checked').val()+'&rol='+$('#rol-user-up').val()+ '&fechaNac='+$('#datepicker5').val()+ '&edo='+$('#edo-user-up').val()+'&mun='+$('#mun-user-up').val()+'&dom='+$('#calle-user-up').val()+'&col='+$('#col-user-up').val()+ '&cp='+$('#cp-user-up').val() +'&telfijo='+$('#tel-user-up').val()+'&telcel='+$('#tel-cel-user-up').val()+'&email='+$('#email-user-up').val(),
			success:function(update)
			{
				console.log(update);
				$("#noti").html('Se ha actualizado correctamente el usuario :)');
				//console.log(user)
				
			},
			error:function(update)
			{
				$("#noti").html('Ha ocurrido un error, comunicate con el area de T.I.');
				//$("#usr-rol-input").html(mun);
				console.log(update)
				
			}
	});
}
function update_password()
{
	//console.log(':)');
	var user = getUrlVars()["user"];
	$("#noti-pass").html('');
	if($('#pass-user-up').val()!= '' && $('#pass1-user-up').val()!='')
	{
		if($('#pass-user-up').val() == $('#pass1-user-up').val())
		{
			$.ajax({
				type:"POST",
				url:"../test.php",
				data:'caso=' + '35'+'&user='+user+ '&pass='+$('#pass-user-up').val(),
				success:function(update)
				{
					console.log(update);
					$("#noti-pass").html('Se ha actualizado correctamente la contraseña :)');
					//console.log(user)
					
				},
				error:function(update)
				{
					$("#noti-pass").html('Ha ocurrido un error, comunicate con el area de T.I.');
					//$("#usr-rol-input").html(mun);
					console.log(update)
					
				}
			});
		}
		else
		{
			$("#noti-pass").html('Las contraseñas deben coincidir ingresa nuevamente el password');
			$('#pass-user-up').val(''); $('#pass1-user-up').val('');
		}
	}
	else
	{
		$("#noti-pass").html('Debes ingresar los pasword!!');
		
	}	
}
function validarEmail(email) {
    if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email))
    {
        return (true)
    } 
    else 
    {
        return (false);
    }
}