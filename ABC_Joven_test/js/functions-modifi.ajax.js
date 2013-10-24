$(document).on('ready',inicio());

function inicio()
{
	
	$("#datepicker4").datepicker({
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
		yearRange: "-90:+0",
		showOn: 'both',
     	buttonImage: 'images/calendar1.png',
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
	}});
	$.datepicker.setDefaults($.datepicker.regional['es']);
	var young = getUrlVars()["young"];
	// console.log(young);
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '28'+'&joven='+young,
			success:function(young)
			{
				//$("#page-datail").append(young);
				//console.log(young);
				var datos = young.split('|');
				segmento(datos[12]);
				edo(datos[10]);
				edo_mun(datos[10],datos[9]);
				$('#nom').val(datos[0]);$('#ap').val(datos[1]);$('#am').val(datos[2]);
				$('#datepicker4').val(datos[6]);
				$('#cp').val(datos[11]); 
				$('#curp').val(datos[3]);$('#rfc').val(datos[4]);$('#calle').val(datos[7]);$('#col').val(datos[8]);
				$('#tel').val(datos[14]+datos[15]);$('#tel-cel').val(datos[16]+datos[17]);
				$('#email').val(datos[18]);$('input[name="est"]:checked').val(datos[13]);

				if(datos[5]== 'M')
				{
					$('#h').attr('checked',true);
				}
				else if(datos[5]== 'F')
				{
					$('#m').attr('checked',true);
				}

				if(datos[13]==1)
				{
					$('#si').attr('checked',true);
				}
				else if(datos[13]==0)
				{
					$('#no').attr('checked',true);
				}
				//console.log($("#edo option[value="+datos[10]+"]").attr("selected",true));
				//console.log(datos[10]);
			},
			error:function(young)
			{
				//$("#usr-rol-input").html(mun);
				console.log(young);
			}
	});
	eventos(young);
	$('#page-datail').on('click', 'input[type="submit"]', saveYoun);
	$('#page-datail').on('click', 'a', delete_event);
	//$('#page-datail').on('click', 'button',datepicker4);

}
function segmento(seg)
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '10' +'&seg='+seg,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(seg){
			$('#seg').prepend(seg);
			//console.log(seg);
		},
		//timeout: 4000,
		error: function(seg){
			//console.log(seg);
		}
	});
}
function edo_mun(estado,mun){
	if($('#edo').find(':selected').val() != '0')
	{
		//alert($('#edo').find(':selected').val());
		$.ajax({
			async: true,
			type: "POST",
			dataType:  "html",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			url: "test.php",
			data: 'caso=' + '38' +'&estado=' + estado +'&mun='+mun,//+ '&login_userpass=' + $('#password').val(),
			//beforeSend: funcion,		
			success:function(muns){
				$("#mun-edo").html(muns);
				//console.log(muns);
			},
			//timeout: 4000,
			error: function(datos){
				console.log(muns);
			}
		});
	}	
}
function edo(estado)
{
	//console.log(estado);
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso='+'37'+'&edo='+estado,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(estado){
			$("#edo").html(estado);
			//console.log(estado);
		},
		//timeout: 4000,
		error: function(datos){
			//console.log(user);
		}
	});
}
function eventos(young){
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '40'+'&joven='+young,
			success:function(young)
			{
				$("#page-datail").append(young);
			},
			error:function(young)
			{
				//$("#usr-rol-input").html(mun);
				console.log(young);
			}
	});
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function saveYoun()
{
	var young = getUrlVars()["young"];
	// console.log($('#nom').val()+ young);
	$("#noti").html('');
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '29'+'&joven='+young + '&nombre='+$('#nom').val()+ '&ap='+$('#ap').val()+ '&am='+$('#am').val()+ '&genero='+$('input[name="genero"]:checked').val()+'&seg='+$('#seg').val()+ '&fechaNac='+$('#datepicker4').val()+ '&edo='+$('#edo').val()+'&mun='+$('#mun-edo').val()+'&curp='+$('#curp').val()+'&rfc='+$('#rfc').val()+'&dom='+$('#calle').val()+'&col='+$('#col').val()+'&telfijo='+$('#tel').val()+'&telcel='+$('#tel-cel').val()+'&email='+$('#email').val()+'&est='+$('input[name="est"]:checked').val(),
			success:function(update)
			{
				//console.log(update);
				$("#noti").html('Se ha actualizado correctamente el joven :)');
				//console.log(young)
				
			},
			error:function(update)
			{
				$("#noti").html('Ha ocurrido un error, comunicate con el area de T.I.');
				//$("#usr-rol-input").html(mun);
				console.log(update)
				
			}
	});
}
function delete_event(datos)
{
	var id = datos.currentTarget.id; 
	var dato= datos.currentTarget.name;
	$("#noti2").html('');
	$( "#dialog-confirm" ).html('¿Quieres eliminar el evento <b>'+dato+'<b>?');	
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 150,
      width: 610,
      modal: true,
      title: "Eliminar Evento",
      //content: "Quieres eliminar el evento?",
      buttons: {
        "Eliminar": function() {  
        $.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '30'+ '&evento='+id + '&no_control='+dato,
			success:function(evento)
			{
				if(evento == '1')
				{
					//alert('Se ha Eliminado el evento correctamente :)');
					location.reload();
				}
				else
					$("#noti2").html(evento);
				//$("#page-datail").html('');
				//inicio();
			},
			// complete:function(evento)
			// {
			// 	console.log(':)');
			// },
			error:function(evento)
			{
				//$("#usr-rol-input").html(mun);
				console.log(evento+':(');
				
			}
			});
          $( this ).dialog( "close" );
        },
        Cancelar: function() {
          $( this ).dialog( "close" );
        }
      }
    });
	
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
