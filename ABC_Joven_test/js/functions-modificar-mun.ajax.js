$(document).on('ready',inicio());

function inicio()
{
	var mun = getUrlVars()["mun"];
	// console.log(mun);
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '47'+'&mun='+mun,
			success:function(mun)
			{
				var datos = mun.split('|');
				$('#up-mun-input').val(datos[0]);
				edo(datos[1]);
			},
			error:function(mun)
			{
				//$("#usr-rol-input").html(mun);
				console.log(mun);
			}
	});
	$('#update-mun').on('click',updamun);

}
function updamun()
{
	var mun = getUrlVars()["mun"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '48'+'&mun='+$('#up-mun-input').val()+'&edo='+$('#up-edomun-input').val()+'&id='+mun,
			success:function(update)
			{
				console.log(update);
				if(update == '1')
				{
					$('#noti-mun-update').html('Se ha actualizado el Municipio.');
				}
				else
					$('#noti-mun-update').html('Error al actualizar.');
			},
			error:function(update)
			{
				//$("#usr-rol-input").html(update);
				console.log(update);
			}
	});
}
function edo(estado)
{
	//console.log(estado);
	$.ajax({
		async: true,
		type: "POST",
		dataType:  "html",
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		url: "../test.php",
		data: 'caso='+'37'+'&edo='+estado,//+ '&login_userpass=' + $('#password').val(),
		//beforeSend: funcion,
		
		success:function(estado){
			$("#up-edomun-input").html(estado);
			//console.log(estado);
		},
		//timeout: 4000,
		error: function(datos){
			//console.log(user);
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