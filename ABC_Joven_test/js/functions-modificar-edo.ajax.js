$(document).on('ready',inicio());

function inicio()
{
	var estado = getUrlVars()["estado"];
	// console.log(estado);
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '45'+'&estado='+estado,
			success:function(estado)
			{
				//$("#page-datail").append(young);
				//console.log(young);
				//var datos = estado.split('|');
				$('#up-edo-input').val(estado);
				console.log(estado)
				//console.log($("#edo option[value="+datos[10]+"]").attr("selected",true));
				//console.log(datos[10]);
			},
			error:function(estado)
			{
				//$("#usr-rol-input").html(mun);
				console.log(estado);
			}
	});
	$('#update-edo').on('click',updaedo);

}
function updaedo()
{
	var estado = getUrlVars()["estado"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '46'+'&estado='+estado+'&nombre='+$('#up-edo-input').val(),
			success:function(estado)
			{
				if(estado == '1')
				{
					$('#noti-edo-update').html('Se ha actualizado el estado.');
				}
				else
					$('#noti-edo-update').html('Error al actualizar.');
			},
			error:function(estado)
			{
				//$("#usr-rol-input").html(mun);
				console.log(estado);
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