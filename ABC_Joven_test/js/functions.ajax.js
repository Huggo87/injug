$(document).on('ready',inicio());
//$("#datepicker").on('click',fecha());
function inicio()
{
	//$('nav').on("click", menuOption);
	perfilUser();
	ocultaWindows();
	menu();
	eventos();
	responsable();
	municipio();
	edo();
	segmento();

	var anio = new Date();
	$("#datepicker").datepicker({			//autoSize: true,
		changeMonth: true,
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
		     // alert(anioActual+' '+mesActual+' '+diaActual); || (dateAsObject.getMonth()+1) > mesActual || dateAsObject.getDate()>diaActual
		     // alert(dateAsObject.getFullYear() +' '+ (dateAsObject.getMonth()+1) +' '+ dateAsObject.getDate() );
		     if(dateAsObject.getFullYear() > anioActual )
		     {
		     	$('#datepicker').val(' ');
		     	alert('Año mayor al actual');
		     }
		     else if(dateAsObject.getFullYear() == anioActual)
		     {
		     	if((dateAsObject.getMonth()+1) > mesActual)
		     	{
		     		$('#datepicker').val(' ');
		     		alert('Mes seleccionado es mayor al actual');
		     	}
		     	else if((dateAsObject.getMonth()+1) == mesActual)
		     	{
		     		if(dateAsObject.getDate()>diaActual)
		     		{
		     			$('#datepicker').val(' ');
		     			alert('Dia mayor al dia de hoy');
		     		}
		     	}
		     }
		      //
		}
	});
	$( "#datepicker3" ).datepicker({
		//autoSize: true,
		changeYear: true,
		changeMonth: true,
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
		showOn: 'both',
		buttonImage: 'images/calendar1.png',
		yearRange: "2007:+0",//+ anio.getFullYear(), "-90:+0"
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
		     	$('#datepicker3').val(' ');
		     	alert('Año mayor al actual');
		     }
		     else if(dateAsObject.getFullYear() == anioActual)
		     {
		     	if((dateAsObject.getMonth()+1) > mesActual)
		     	{
		     		$('#datepicker3').val(' ');
		     		alert('Mes seleccionado es mayor al actual');
		     	}
		     	else if((dateAsObject.getMonth()+1) == mesActual)
		     	{
		     		if(dateAsObject.getDate()>diaActual)
		     		{
		     			$('#datepicker3').val(' ');
		     			alert('Dia mayor al dia de hoy');
		     		}
		     	}
					     }
	}});
	$( "#datepicker1" ).datepicker({
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
			showOn: 'both',
     		buttonImage: 'images/calendar1.png',
			yearRange: "-90:+0",
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
	//Captura de responsable
	$( "#datepicker2" ).datepicker({
		//autoSize: true,
		changeYear: true,
		changeMonth: true,
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
		showOn: 'both',
     	buttonImage: 'images/calendar1.png',
		yearRange: "-90:+0",
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
		     	$('#datepicker3').val(' ');
		     	alert('Año mayor al actual');
		     }
		     else if(dateAsObject.getFullYear() == anioActual)
		     {
		     	if((dateAsObject.getMonth()+1) > mesActual)
		     	{
		     		$('#datepicker3').val(' ');
		     		alert('Mes seleccionado es mayor al actual');
		     	}
		     	else if((dateAsObject.getMonth()+1) == mesActual)
		     	{
		     		if(dateAsObject.getDate()>diaActual)
		     		{
		     			$('#datepicker3').val(' ');
		     			alert('Dia mayor al dia de hoy');
		     		}
		     	}
		     }
	}});
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$('#save').on('click', guardarJoven);
	$('#nav #menu').on('click', 'li a',  menuOption);
	$('#cat-nav').on('click', 'li a',  menuOptionCatalog);
	$('#sea-jov').on('click',  buscarxNomrbe);
	$('#sea-eve').on('click',  buscarxEvento);
	$('#find').on('click', 'a', detalleJoven);
	$('#save-user').on('click', saveUser);
	$('#save-edo').on('click', savecat_Edo);
	$('#save-cat-mun').on('click', savecat_Mun);
	$('#save-evento').on('click', savecat_Evento);
	$('#save-seg').on('click', savecat_Segmento);
	$('#save-tal').on('click', savecat_Talento);
	$('#save-rol').on('click', savecat_Rol);
	$('#find').on('click', 'a', eliminar_joven);
	$('#user-find').on('click', 'a', eliminar_user);
	$('#reset-jov').on('click', resetjoven);
	$('#reset-event').on('click', resetevento);
	$('#cat-edo').on('click', 'a', eliminiar_edo);
	$('#cat-mun').on('click', 'a', eliminiar_mun);
	$('#cat-evt').on('click', 'a', eliminiar_evt);
	$('#cat-seg').on('click', 'a', eliminiar_seg);
	$('#cat-tal').on('click', 'a', eliminiar_tal);
	$('#cat-rol').on('click', 'a', eliminiar_rol);
	$("#escuela").hide();
	var activate = false;
	console.log(activate);
}
function eliminiar_edo(estado)
{
	var id   = estado.currentTarget.id;
	var text = estado.currentTarget.rel;
	//console.log(id+' '+text);
	if (text == 'Eliminar')
	{
		$.ajax({
			type:"POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "text",
			url:"test.php",
			data:'caso=' +'61'+ '&edo='+id,
			success:function(edo)
			{
				// console.log(edo);
				alert(edo);
				viewEstados();
			},
			error:function(edo)
			{
				console.log(edo);
				alert('Erro en el core del sistema verifica sesion');
			}
		});
	}

}
function eliminiar_mun(mun)
{
	var id   = mun.currentTarget.id;
	var text = mun.currentTarget.rel;
	//console.log(id+' '+text);
	if (text == 'Eliminar')
	{
		$.ajax({
			type:"POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "text",
			url:"test.php",
			data:'caso=' +'62'+ '&mun='+id,
			success:function(mun)
			{
				// console.log(mun);
				alert(mun);
				viewMun();
			},
			error:function(mun)
			{
				console.log(mun);
				alert('Erro en el core del sistema verifica sesion');
			}
		});
	}

}
function eliminiar_evt(evento)
{
	var id   = evento.currentTarget.id;
	var text = evento.currentTarget.rel;
	//console.log(id+' '+text);
	if (text == 'Eliminar')
	{
		$.ajax({
			type:"POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "text",
			url:"test.php",
			data:'caso=' +'63'+ '&evnt='+id,
			success:function(evnt)
			{
				// console.log(evnt);
				alert(evnt);
				viewEvento();
			},
			error:function(evnt)
			{
				console.log(evnt);
				alert('Erro en el core del sistema verifica sesion');
			}
		});
	}

}
function eliminiar_seg(segmento)
{
	var id   = segmento.currentTarget.id;
	var text = segmento.currentTarget.rel;
	//console.log(id+' '+text);
	if (text == 'Eliminar')
	{
		$.ajax({
			type:"POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "text",
			url:"test.php",
			data:'caso=' +'64'+ '&seg='+id,
			success:function(seg)
			{
				// console.log(seg);
				alert(seg);
				viewSegmento();
			},
			error:function(seg)
			{
				console.log(seg);
				alert('Erro en el core del sistema verifica sesion');
			}
		});
	}

}
function eliminiar_tal(talento)
{
	var id   = talento.currentTarget.id;
	var text = talento.currentTarget.rel;
	//console.log(id+' '+text);
	if (text == 'Eliminar')
	{
		$.ajax({
			type:"POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "text",
			url:"test.php",
			data:'caso=' +'65'+ '&tal='+id,
			success:function(tal)
			{
				// console.log(tal);
				alert(tal);
				viewTalento();
			},
			error:function(tal)
			{
				console.log(tal);
				alert('Erro en el core del sistema verifica sesion');
			}
		});
	}

}
function eliminiar_rol(rol)
{
	var id   = rol.currentTarget.id;
	var text = rol.currentTarget.rel;
	//console.log(id+' '+text);
	if (text == 'Eliminar')
	{
		$.ajax({
			type:"POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "text",
			url:"test.php",
			data:'caso=' +'66'+ '&rol='+id,
			success:function(rol)
			{
				// console.log(rol);
				alert(rol);
				viewRol();
			},
			error:function(rol)
			{
				console.log(rol);
				alert('Erro en el core del sistema verifica sesion');
			}
		});
	}

}
function resetevento()
{
	$('.busqueda-evento input:text').val('');
	$(".busqueda-evento select").val('');
}

function resetjoven()
{
	$('.busqueda-jov input:text').val('');
}

function eliminar_joven(joven)
{
	var id   = joven.currentTarget.id;
	var text = joven.currentTarget.rel;
	var consulta = joven.currentTarget.name;
	//console.log(text);
	$('#noti-green-find').html(' ');
	$('#noti-blue-find').html(' ');
	$('#noti-red-find').html(' ');
	if (text == 'Eliminar')
	{
		$( "#dialog-confirm-delete-young" ).html('¿Quieres elimiar al joven con el ID <b>'+id+'<b>?');		
	  	$( "#dialog-confirm-delete-young" ).dialog({
	     	resizable: false,
	    	height: 150,
	     	width: 610,
	      	modal: true,
	      	title: "Eliminar joven",
	      	//content: "Quieres eliminar el joven?",
      	  	buttons: {
	      		"Eliminar": function() {
				  	$.ajax({
						type:"POST",
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						//contentType: "text/html",
						dataType:  "text",
						url:"test.php",
						data:'caso=' +'31'+ '&joven='+id,
						success:function(joven)
						{
							//console.log(joven);
							if(joven == '1' )
							{
								
								if(consulta== '2')
									buscarxNomrbe();
								else if(consulta == '3')
									buscarxEvento();
								$('#noti-green-find').html('El joven se ha eliminado correctamente :)');
							}
							else if(joven == '2')
							{
								$('#noti-blue-find').html('Error al realizar la operacion consulta al area de T.I.');
								console.log(joven);
							}
							else if(joven == '3')
							{
								$('#noti-red-find').html('El joven no puede ser eliminado solo el usuario que lo capturo puede eliminarlo.');
								console.log(joven);
							}
							else if(joven == '0')
							{
								$('#noti-red-find').html('El Joven no puede ser eliminado, tiene eventos relacionados');
								console.log(joven);
							}

						},
						error:function(joven)
						{
							console.log(joven);
							alert('Ha ocurrido un error comunicate con el area de T.I.');
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
}
function eliminar_user(user)
{
	var id   = user.currentTarget.id;
	var text = user.currentTarget.name;
	if (text == 'Eliminar')
	{
		$( "#dialog-confirm-delete-user" ).html('¿Quieres elimiar el usuario con el ID <b>'+id+'</b>?');		
	  	$( "#dialog-confirm-delete-user" ).dialog({
	     	resizable: false,
	    	height: 150,
	     	width: 610,
	      	modal: true,
	      	title: "Eliminar usuario",
	      	//content: "Quieres eliminar el joven?",
      	  	buttons: {
	      		"Eliminar": function() {
					$.ajax({
							type:"POST",
							url:"test.php",
							data:'caso=' +'36'+ '&user='+id,
							success:function(user)
							{
								//console.log(user);
								if(user == '1' )
								{
									alert('El usuario se ha eliminado correctamente :)');
									viewUsers();
								}
								else
								{
									alert('Ha ocurrido un error!!');
									console.log(user);
								}
							},
							error:function(user)
							{
								console.log(user);
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
}
function savecat_Rol()
{
	if($('#cat-rol-input').val()!='')
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '26'+'&cat-rol-save='+$('#cat-rol-input').val(),
			success:function(rol)
			{
				//$("#usr-rol-input").html(rol);
				console.log(rol)
				alert('Se ha guardado el Rol ' +$('#cat-rol-input').val()+ ' correctamente :)');
				$('#cat-rol-input').val('');
				viewRol();
			},
			error:function(rol)
			{
				//$("#usr-rol-input").html(mun);
				console.log(rol)
				alert('No se guardo el Rol ha courrido un error :( !');
			}
	});
	}
	else
	{
		alert('Debes ingresar el Rol ;(')
	}
}
function savecat_Talento()
{
	if($('#cat-tal-input').val()!='')
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '25'+'&cat-tal-save='+$('#cat-tal-input').val(),
			success:function(tal)
			{
				//$("#usr-rol-input").html(rol);
				console.log(tal)
				alert('Se ha guardado el Talento ' +$('#cat-tal-input').val()+ ' correctamente :)');
				$('#cat-tal-input').val('');
				viewTalento();
			},
			error:function(tal)
			{
				//$("#usr-rol-input").html(mun);
				console.log(tal)
				alert('No se guardo el Talento ha courrido un error :( !');
			}
		});
	}
	else
	{
		alert('Debes ingresar el Talento ;(')
	}
}
function savecat_Segmento()
{
	if($('#cat-seg-input').val()!='')
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '24'+'&cat-seg-save='+$('#cat-seg-input').val(),
			success:function(seg)
			{
				//$("#usr-rol-input").html(rol);
				console.log(seg)
				alert('Se ha guardado el Segmento '+$('#cat-seg-input').val()+' correctamente :)');
				$('#cat-seg-input').val('');
				viewSegmento();
			},
			error:function(seg)
			{
				//$("#usr-rol-input").html(mun);
				console.log(seg)
				alert('No se guardo el Segmento ha courrido un error :( !');
			}
		});
	}
	else
	{
		alert('Debes ingresar el Segmento ;(')
	}
}
function savecat_Evento()
{
	if($('#cat-evento-input').val()!='' && $('#even-linea').val()!='0' && $('#even-estr').val()!='0' && $('#even-prog').val()!='0' && $('#evento-tipo').val()!='')
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '23'+'&cat-evento-save='+$('#cat-evento-input').val()+'&linea='+$('#even-linea').val()+'&estrategia='+$('#even-estr').val()+'&programa='+$('#even-prog').val()+'&tipo='+$('#evento-tipo').val(),
			success:function(evnt)
			{
				//$("#usr-rol-input").html(rol);
				if( evnt == '3')
				{
					alert('Evento ya existe');
				}
				else
				{
					//console.log(evnt)
					alert('Se ha guardado el Evento ' +$('#cat-evento-input').val() + ' correctamente :)');
					$(".clear-evento input:text").val('');
					$(".clear-evento input:radio").attr("checked", false);
					$(".clear-evento select").val('');
					viewEvento();
				}
				
			},
			error:function(evnt)
			{
				//$("#usr-rol-input").html(mun);
				console.log(evnt)
				alert('No se guardo el Evento ha courrido un error :( !');
			}
		});
	}
	else
	{
		alert('Debes ingresar los datos completos del Evento ;(');
	}
}
function savecat_Mun()
{
	if ($('#cat-mun-input').val()!='' && $('#cat-edomun-input').val()!='0') 
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '22'+'&cat-mun-save='+$('#cat-mun-input').val()+'&cat-edomun-save='+$('#cat-edomun-input').val(),
			success:function(mun)
			{
				alert('Se ha guardado el Municipio '+$('#cat-mun-input').val()+ ' correctamente :)');
				$('#cat-mun-input').val('');
				viewMun();
			},
			error:function(mun)
			{
				//$("#usr-rol-input").html(mun);
				console.log(mun)
				alert('No se guardo el Municipio ha courrido un error :( !');
			}
		});
	}
	
	else
	{
		alert('Debes ingresar el Municipio ;(')
	}
}
function savecat_Edo()
{
	if($('#cat-edo-input').val()!= '')
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '21'+'&cat-edo-save='+$('#cat-edo-input').val(),
			success:function(edo)
			{
				//$("#usr-rol-input").html(rol);
				//console.log(rol)
				alert('Se ha guardado el Estado '+$('#cat-edo-input').val() +' correctamente :)');
				//alert('');
				$('#cat-edo-input').val('');
				viewEstados();
				
			},
			error:function(edo)
			{
				//$("#usr-rol-input").html(rol);
				//console.log(rol)
				alert('No se guardo el Estado ha courrido un error :( !');
			}
	});
	}
	else
	{
		alert('Debes ingresar el Estado ;(')
	}
}
function saveUser()
{
	if($('#usr-nomuser-input').val()!='' && $('#usr-pass-input').val()!='' && $('#usr-rol-input').val()!='0' && $('#usr-nombre-input').val()!='' &&  $('#usr-apa-input').val()!='' && $('#usr-edo-input').val()!='' && $('#usr-mun-input').val()!='' && $('#usr-email-input').val()!='')
	{
		$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '20'+'&usr-resp='+$('#usr-resp-input').val()+'&usr-nomuser=' + $('#usr-nomuser-input').val()+ '&usr-pass=' + $('#usr-pass-input').val() + '&usr-rol=' + $('#usr-rol-input').val() + '&usr-nombre='+ $('#usr-nombre-input').val()+ '&usr-apa='+ $('#usr-apa-input').val()+ '&usr-ama='+ $('#usr-ama-input').val()+ '&usr-gen='+ $('input[name="usr-gen-input"]:checked').val()+ '&fechaNacUser='+ $('#datepicker2').val()+ '&usr-dom='+ $('#usr-dom-input').val()+ '&usr-col='+ $('#usr-col-input').val()+ '&usr-edo='+ $('#usr-edo-input').val()+ '&usr-mun='+ $('#usr-mun-input').val()+ '&usr-cp='+ $('#usr-cp-input').val()+ '&usr-tel='+ $('#usr-tel-input').val()+ '&usr-telcel='+ $('#usr-telcel-input').val()+ '&usr-email='+ $('#usr-email-input').val(),
			success:function(user)
			{
				//$("#usr-rol-input").html(rol);
				//console.log(rol)
				if( user == '3')
				{
					alert('Nombre de usuario ya existe');
				}
				else
				{
					alert( user );
					$(".clear-user input:text").val('');
					$(".clear-user input:radio").attr("checked", false);
					$(".clear-user select").val('');
				}
				
			},
			error:function(user)
			{
				//$("#usr-rol-input").html(rol);
				//console.log(rol)
				alert( user );
			}
	});
	}
	else
	{
		alert('Debes ingresar datos completos para guardar al usuario');
	}	
}
function perfilUser()
{
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '0',
			dataType: 'text',
			//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#user-perfil").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#user-perfil").html(data);
				//console.log(data)
			}
		});
}
function detalleJoven(){
	var boton =  $(this).attr("class");
	//$('#modal').html('<p>Cliente Testimoni Juan Antonio Cedillo Campos</p><p>Cliente Testimoni Juan Antonio Cedillo Campos</p><p>Cliente Testimoni Juan Antonio Cedillo Campos</p>');
	//alert(boton);
}
function generateControl(resp,mun,evento,fecha,hora)
{
	//RESPONSABLE
	if(resp < 10){resp= '00' + resp;}
	else if(resp >= 10 && resp <100){resp= '0' + resp;}	
	else if  (resp >= 100) {resp= resp;}
	//MUNICIPIO
	if(mun <10){mun = '0' + mun;}
	else if(mun >= 10){mun = mun;}
	//EVENTO
	if(evento <10){evento = '0000'+ evento;}
	else if(evento >=10 && evento <100){evento = '000'+ evento;}
	else if(evento >=100 && evento <1000){evento = '00'+ evento;}
	else if(evento >=1000 && evento <10000){evento = '0'+ evento;}
	dato = resp+mun+evento+fecha+'-'+hora;
	return dato;
	//alert(resp+mun+evento+fecha+'-'+hora);
}
function buscarxNomrbe()
{
	if($('#search-name').val()!='' || $('#search-name').val()!='' || $('#search-am').val()!='')
	{
		$("#find").html("<div align='center'><img id='load' src='../img/cargando.gif'/> </div>");
		
		$.ajax({
			async: true,
			type: "POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "html",
			url: "test.php",
			//textHtml: true,
			data: 'caso=' + '2' + '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),//+ '&login_userpass=' + $('#password').val(),
			//beforeSend: funcion,
			
			success:function(datos){
				$("#find").html(datos);

				//console.log(datos);
			},
			//timeout: 4000,
			error: function(datos){
				//$("#find").html('No se encontraro Jovenes con el nombre ingresado');
				//console.log(datos);
			}
		});
	}
	else
	{
		alert('Debes ingresar nombre del Joven a buscar');
	}
}
function buscarxEvento()
{
	
	if($('#res-bus').val()!='0' && $('#mun-bus').val()!='0' && $('#evnt-bus').val()!='0' && $('#datepicker3').val()!='' && $('#hour-bus').val()!='0')
	{
		$("#find").html("<div align='center'><div><img id='load' src='../img/cargando.gif'/></div>");
		var noControl = generateControl($('#res-bus').val(),$('#mun-bus').val(),$('#evnt-bus').val(),$('#datepicker3').val(),$('#hour-bus').val());
		//$("#find").html("Buscando Evento....");
		$.ajax({
			async: true,
			type: "POST",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			//contentType: "text/html",
			dataType:  "html",
			url: "test.php",
			//textHtml: true,
			data: 'caso=' + '3' + '&find-evnt='+noControl,//+ '&login_userpass=' + $('#password').val(),
			//beforeSend: funcion,
			
			success:function(datos){
				$("#find").html(datos);
				//console.log(datos);
			},
			//timeout: 4000,
			error: function(datos){
				//$("#find").html('No se encontraro Jovenes con el nombre ingresado');
				console.log(datos);
			}
		});
	}
	else
	{
		alert('Debes ingresar datos del Evento a buscar');
	}
}
function guardarJoven()
{
	//alert(':)');
	if( $('#evnt').val() =='0' || $('#res').val() =='0' || $('#mun').val() =='0' || $('input[name="sector"]:checked').val() == null || $('#datepicker').val()=='' || $('#hour').val()== '0' )
	{
		alert('Faltan datos para registrar el evento.');
	}
	else
	{
		if( $('#nom').val() != '' )
		{
			if( $('#ap').val()!= '' || $('#am').val()!= '')
			{
				if( $('input[name="genero"]:checked').val() != null )
				{
					if( $('#edo').val() !='0' && $('#mun-edo').val() !='0' )
					{

						if( $('#email').val() != '' )
						{
							if( validarEmail($('#email').val()) )
							{
								if( $('input[name="est"]:checked').val() != null )
								{
									
									if(activate)
									{
										
										if( $('#mun-esc').val()!='0' || $('#nivel').val()!='0' || $('#esc-ins').val()!='0' )
										{
											
											enviarDatosJovenEvento();
										}
										else
										{
											alert('Debes seleccionar datos completos de la escuela (Municipio, Nivel y Escuela)');
										}
									}
									else
									{
										
										enviarDatosJovenEvento();

									}	
								}
								else
								{
									alert('Debes seleccionar si el joven estudia actualmente');
								}
							}
							else
							{
								alert('Email incorrecto captura nuevamente');
							}
						}
						else
						{
							if( $('input[name="est"]:checked').val() != null )
							{
								
								if(activate)
								{
									
									if( $('#mun-esc').val()!='0' && $('#nivel').val()!='0' && $('#esc-ins').val()!='0' )
									{
										
										enviarDatosJovenEvento();
									}
									else
									{
										alert('Debes seleccionar datos completos de la escuela (Municipio, Nivel y Escuela)');
									}
								}
								else
								{
									
									enviarDatosJovenEvento();

								}	
							}
							else
							{
								alert('Debes seleccionar si el joven estudia actualmente');
							}
						}
					}
					else
					{
						alert('Debes seleccionar Estado y Municipio');
					}
				}
				else
				{
					alert('Debes seleccionar Sexo del Joven');
				}
			}
			else
			{
				alert('Debes ingresar al menos le primer apellido');
			}
		}
		else
		{
			alert('Falta nombre del joven');
		}
	}
	//alert($('input[name="sector"]:checked').val());
}
function enviarDatosJovenEvento()
{
	var noControl = generateControl($('#res').val(),$('#mun').val(),$('#evnt').val(),$('#datepicker').val(),$('#hour').val());
	//var edad= edadJoven($('#datepicker1').val());
	$.ajax({
			async: true,
			type: "POST",
			contentType: "application/x-www-form-urlencoded; charset=utf-8",
			//contentType: "text/html",
			dataType:  "html",
			url: "test.php",
			//textHtml: true,
			data: 'caso='+'4'+'&nombre='+$('#nom').val()+'&apa='+$('#ap').val()+'&ama='+$('#am').val()+'&genero='+$('input[name="genero"]:checked').val()+'&segmento='+$('#seg').val()+'&fechaNac='+$('#datepicker1').val()+'&edo='+$('#edo').val()+'&mun='+$('#mun-edo').val()+'&curp='+$('#curp').val()+'&rfc='+$('#rfc').val()+'&dom='+$('#calle').val()+'&col='+$('#col').val()+'&telfijo='+$('#tel').val()+'&telcel='+$('#tel-cel').val()+'&email='+$('#email').val()+'&est='+$('input[name="est"]:checked').val()+'&munesc='+$('#mun-esc').val()+'&esc-ins='+$("#esc-ins").val()+'&cat_ev='+$('#evnt').val()+'&fechaEv='+$('#datepicker').val()+'&obs='+$('#obs').val()+'&evento='+noControl+'&place='+$('#place').val()+'&sector='+$('input[name="sector"]:checked').val(),
			//beforeSend: funcion,
			
			success:function(datos){
				if( datos == '1')
				{
					$("#noti-red p").html('');
					$("#noti-blue p").html('');
					$("#noti-green p").html('El Joven <b>'+$('#nom').val()+' '+$('#ap').val()+' '+$('#am').val()+'</b> se ha guardo correctamente en el evento.');
				}
				else if(datos == '2')
				{
					$("#noti-red p").html('');
					$("#noti-green p").html('');
					$("#noti-blue p").html('El Joven <b>'+$('#nom').val()+' '+$('#ap').val()+' '+$('#am').val()+'</b> ya existe y se ha dado de alta el evento.');
				}
				else if(datos == '3')
				{
					$("#noti-green p").html('');
					$("#noti-blue p").html('');
					$("#noti-red p").html('El Joven <b>'+$('#nom').val()+' '+$('#ap').val()+' '+$('#am').val()+'</b> ya existe en el evento.');
				}
				else
				{
					$("#noti-green p").html('');
					$("#noti-blue p").html('');
					$("#noti-red p").html('Error al guardar joven acudde al area de T.I.');
				}

				
				$(".clear-jov input:text").val('');
				$("#email").val('');
				$(".clear-jov input:radio").attr("checked", false);
				$(".clear-jov select").val('');
				$("#escuela").hide();
				//console.log(user);
			},
			//timeout: 4000,
			error: function(datos){
				console.log(datos);
			}


		});
}
$('#edo').change(function(){
	if($('#edo').find(':selected').val() != '0')
	{
		//alert($('#edo').find(':selected').val());
		$.ajax({
			async: true,
			type: "POST",
			dataType:  "html",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			url: "test.php",
			data: 'caso=' + '9' +'&estado=' + $('#edo').find(':selected').val(),//+ '&login_userpass=' + $('#password').val(),
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
});
$('#usr-edo-input').change(function(){
	if($('#usr-edo-input').find(':selected').val() != '0')
	{
		$.ajax({
			async: true,
			type: "POST",
			dataType:  "html",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			url: "test.php",
			data: 'caso=' + '19' +'&estado-User=' + $('#usr-edo-input').find(':selected').val(),//+ '&login_userpass=' + $('#password').val(),
			//beforeSend: funcion,		
			success:function(muns){
				$("#usr-mun-input").html(muns);
				console.log(muns);
			},
			//timeout: 4000,
			error: function(datos){
				console.log(muns);
			}
		});
	}	
});
function menu()
{
	$.ajax({
		async: true,
		type: "POST",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		//contentType: "text/html",
		dataType:  "html",
		url: "test.php",
		//textHtml: true,
		data: 'caso=' + '1',//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(datos){
			$("#menu").prepend(datos);
			//console.log(user);
		},
		//timeout: 4000,
		error: function(datos){
			//console.log(user);
		}
	});
}
function edo()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '5' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(estado){
			$("#edo").append(estado);
			//console.log(estado);
		},
		//timeout: 4000,
		error: function(datos){
			//console.log(user);
		}
	});
}
function ver_Estados_CatMun()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '5' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(estado){
			$("#cat-edomun-input").html(estado);
			//console.log(estado);
		},
		//timeout: 4000,
		error: function(datos){
			//console.log(user);
		}
	});
}
function edoUsuer()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '5' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(estado){
			//$("#edo").append(estado);
			$('#usr-edo-input').html(estado);
			//console.log(estado);
		},
		//timeout: 4000,
		error: function(datos){
			//console.log(user);
		}
	});
}
function eventos()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '6' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(evento){
			$("#evnt").append(evento);
			$('#evnt-bus').append(evento);
			//console.log(evento);
		},
		//timeout: 4000,
		error: function(evento){
			//console.log(user);
		}
	});
}
function responsable()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '7' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(resp){
			$("#res").append(resp);
			$("#res-bus").append(resp);
			//console.log(resp);
		},
		//timeout: 4000,
		error: function(resp){
			//console.log(user);
		}
	});
}
function resUser()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '7' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(resp){
			$('#usr-resp-input').html(resp);
			//console.log(resp);
		},
		//timeout: 4000,
		error: function(resp){
			//console.log(user);
		}
	});
}
function municipio()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '8' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(mun){
			$("#mun").append(mun);
			$("#mun-bus").append(mun);
			$('#mun-esc').append(mun);
			//console.log(mun);
		},
		//timeout: 4000,
		error: function(mun){
			//console.log(user);
		}
	});
}
function segmento()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '10' ,//+ '&login_userpass=' + $('#password').val(),
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
function menuOption(dato)
{
	var boton =  $(this).attr("id");
	 //var boton = dato.currentTarget.id;
	//console.log(boton);//debugger  
	//boton.fadeIn();
	//$('#page').html('');
	if(boton == 'busquedas')
	{
		var datos= $('#'+ boton + '-page').show();
		$('#altas-page').hide();
		$('#catalogos-page').hide();
		$('#usuarios-page').hide();	
		//$('#find').html('');
	}
	else if(boton == 'altas')
	{
		var datos= $('#'+ boton + '-page').show();
		$('#busquedas-page').hide();
		$('#catalogos-page').hide();
		$('#usuarios-page').hide();
		nivel();	
	}
	else if(boton == 'catalogos')
	{
		var datos= $('#'+ boton + '-page').show();
		$('#altas-page').hide();
		$('#busquedas-page').hide();
		$('#usuarios-page').hide();
		//$('#catalogo-page').hide();	
	}
	else if(boton == 'usuarios')
	{
		var datos= $('#'+ boton + '-page').show();
		$('#altas-page').hide();
		$('#busquedas-page').hide();
		$('#catalogos-page').hide();
		viewUsers();
		resUser();
		roles();
		edoUsuer();
	}
	
	page = $('#page').show();
	//console.log(datos);
	//console.log(page);
	//$('#busquedas-page').hide(5000)
	//post code
	//alert(boton);
}
function menuOptionCatalog(data)
{
	var boton =  $(this).attr("id");
	//console.log(boton);
	if(boton == 'catmenu-edo')
	{
		$('#cat-edo').show();
		$('#cat-mun').hide();
		$('#cat-evt').hide();
		$('#cat-seg').hide();
		$('#cat-tal').hide();
		$('#cat-rol').hide();
		viewEstados();
	}
	else if(boton == 'catmenu-mun')
	{
		$('#cat-edo').hide();
		$('#cat-mun').show();
		$('#cat-evt').hide();
		$('#cat-seg').hide();
		$('#cat-tal').hide();
		$('#cat-rol').hide();
		viewMun();
		ver_Estados_CatMun();
	}
	else if(boton == 'catmenu-evento')
	{
		$('#cat-edo').hide();
		$('#cat-mun').hide();
		$('#cat-evt').show();
		$('#cat-seg').hide();
		$('#cat-tal').hide();
		$('#cat-rol').hide();
		viewEvento();
		evento_linea();
		evento_estrategia();
		evento_programa();

	}
	else if(boton == 'catmenu-seg')
	{
		$('#cat-edo').hide();
		$('#cat-mun').hide();
		$('#cat-evt').hide();
		$('#cat-seg').show();
		$('#cat-tal').hide();
		$('#cat-rol').hide();
		viewSegmento();
	}
	else if(boton == 'catmenu-tal')
	{
		$('#cat-edo').hide();
		$('#cat-mun').hide();
		$('#cat-evt').hide();
		$('#cat-seg').hide();
		$('#cat-tal').show();
		$('#cat-rol').hide();
		viewTalento();
	}
	else if(boton == 'catmenu-rol')
	{
		$('#cat-edo').hide();
		$('#cat-mun').hide();
		$('#cat-evt').hide();
		$('#cat-seg').hide();
		$('#cat-tal').hide();
		$('#cat-rol').show();
		viewRol();
	}
}
function ocultaWindows()
{
	//Menu pricipal
	$('#altas-page').hide();
	$('#busquedas-page').hide();
	$('#catalogos-page').hide();
	$('#usuarios-page').hide();

	//Boton Categorias
	$('#cat-edo').hide();
	$('#cat-mun').hide();
	$('#cat-evt').hide();
	$('#cat-seg').hide();
	$('#cat-tal').hide();
	$('#cat-rol').hide();
}
$("#find").on("click", '.pagination #paginarname', function(){
	$('#find').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	var pagina=$(this).attr("data");
	var cadena="pagina="+pagina;
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '2'+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#find").html(data);
				console.log(data)
			},
			error:function(data)
			{
				console.log(data)
			}
		});
});
$("#find").on("click", '.pagination #paginarevt', function(){
	var noControl = generateControl($('#res-bus').val(),$('#mun-bus').val(),$('#evnt-bus').val(),$('#datepicker3').val(),$('#hour-bus').val());
	$('#find').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	var pagina=$(this).attr("data");
	var cadena="pagina="+pagina;
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '3'+'&screen=' + $(this).attr("data")+ '&find-evnt='+noControl,
			success:function(data)
			{
				$("#find").html(data);
				console.log(data)
			},
			error:function(data)
			{
				console.log(data)
			}
		});
});
function viewUsers()
{
	$('#user-find').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '11',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#user-find").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#user-find").html(data);
				console.log(data)
			}
	});
	//alert(':)');
}
function viewEstados()
{
	//alert(':)');id="cat-find-edo"
	$('#cat-find-edo').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '12',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#cat-find-edo").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#cat-find-edo").html(data);
				console.log(data)
			}
	});
}
function viewMun()	
{
	$('#cat-find-mun').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '13',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#cat-find-mun").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#cat-find-mun").html(data);
				console.log(data)
			}
	});
}
function viewEvento()	
{
	$('#cat-find-evt').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '14',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#cat-find-evt").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#cat-find-evt").html(data);
				//console.log(data)
			}
	});
}
function viewSegmento()
{
	$('#cat-find-seg').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '15',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#cat-find-seg").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#cat-find-seg").html(data);
				console.log(data)
			}
	});
}
function viewTalento()
{
	$('#cat-find-tal').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '16',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#cat-find-tal").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#cat-find-tal").html(data);
				console.log(data)
			}
	});
}
function viewRol()
{
	$('#cat-find-rol').html("<div align='center'><img id='load' src='../img/cargando.gif'/></div>");
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '17',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(data)
			{
				$("#cat-find-rol").html(data);
				//console.log(data)
			},
			error:function(data)
			{
				$("#cat-find-rol").html(data);
				console.log(data)
			}
	});
}
function roles()
{
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '18',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(rol)
			{
				$("#usr-rol-input").html(rol);
				//console.log(rol)
			},
			error:function(rol)
			{
				$("#usr-rol-input").html(rol);
				console.log(rol)
			}
	});
}

function evento_linea()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '41' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(linea){
			$("#even-linea").html(linea);
			//$('#evnt-bus').append(linea);
			//console.log(linea);
		},
		//timeout: 4000,
		error: function(linea){
			//console.log(linea);
		}
	});
}
function evento_estrategia()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '43' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(estrategia){
			$("#even-estr").html(estrategia);
			//$('#evnt-bus').append(estrategia);
			//console.log(estrategia);
		},
		//timeout: 4000,
		error: function(estrategia){
			console.log(estrategia);
		}
	});
}
function evento_programa()
{
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "test.php",
		data: 'caso=' + '42' ,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(programa){
			$("#even-prog").html(programa);
			//$('#evnt-bus').append(programa);
			//console.log(programa);
		},
		//timeout: 4000,
		error: function(programa){
			console.log(programa);
		}
	});
}
function nivel()
{
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '67',//+'&screen=' + $(this).attr("data")+ '&nom=' + $('#search-name').val() + '&apa=' + $('#search-ap').val() + '&ama='+ $('#search-am').val(),
			success:function(nivel)
			{
				$("#nivel").html(nivel);
				//console.log(nivel)
			},
			error:function(nivel)
			{
				$("#nivel").html(nivel);
				console.log(nivel)
			}
	});
}
$('#nivel').change(function(){
	if($('#nivel').find(':selected').val() != '0')
	{
		//alert($('#edo').find(':selected').val());
		$.ajax({
			async: true,
			type: "POST",
			dataType:  "html",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			url: "test.php",
			data: 'caso=' + '68' +'&mun=' + $('#mun-esc').val()+ '&nivel=' + $('#nivel').val(),
				
			success:function(esc){
				$("#esc-ins").html(esc);
				console.log(esc);
			},
			//timeout: 4000,
			error: function(esc){
				console.log(esc);
			}
		});
	}	
});
$('#mun-esc').change(function(){
	if($('#mun-esc').find(':selected').val() != '0')
	{
		//alert($('#edo').find(':selected').val());
		$.ajax({
			async: true,
			type: "POST",
			dataType:  "html",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",
			url: "test.php",
			data: 'caso=' + '68' +'&mun=' + $('#mun-esc').val()+ '&nivel=' + $('#nivel').val(),
				
			success:function(esc){
				$("#esc-ins").html(esc);
				console.log(esc);
			},
			//timeout: 4000,
			error: function(esc){
				console.log(esc);
			}
		});
	}	
});

$( 'input[name="est"]' ).on( "click", function() {
	if($('input[name="est"]:checked').val()=='1')
	{
		$("#escuela").slideDown();
		activate = true;
	}
	else
	{
		$("#escuela").slideUp();
		activate = false;
		//$("#escuela select").val('');
		
	}

  console.log($('input[name="est"]:checked').val()+activate);
});


