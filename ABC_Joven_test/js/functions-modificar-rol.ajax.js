$(document).on('ready',inicio());

function inicio()
{
	var rol = getUrlVars()["rol"];
	// console.log(rol);
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '59'+'&rol='+rol,
			success:function(rol)
			{
				//$("#page-datail").append(young);
				//console.log(young);
				//var datos = rol.split('|');
				$('#up-rol-input').val(rol);
				console.log(rol)
				//console.log($("#rol option[value="+datos[10]+"]").attr("selected",true));
				//console.log(datos[10]);
			},
			error:function(rol)
			{
				//$("#usr-rol-input").html(mun);
				console.log(rol);
			}
	});
	$('#update-rol').on('click',updarol);

}
function updarol()
{
	var rol = getUrlVars()["rol"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '60'+'&id='+rol+'&rol='+$('#up-rol-input').val(),
			success:function(rol)
			{
				if(rol == '1')
				{
					$('#noti-rol-update p').html('Se ha actualizado el rol.');
				}
				else
					$('#noti-rol-update p').html('Error al actualizar.');
			},
			error:function(rol)
			{
				//$("#usr-rol-input").html(mun);
				console.log(rol);
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