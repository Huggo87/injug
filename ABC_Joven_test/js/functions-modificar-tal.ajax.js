$(document).on('ready',inicio());

function inicio()
{
	var talento = getUrlVars()["talento"];
	// console.log(talento);
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '57'+'&talento='+talento,
			success:function(talento)
			{
				//$("#page-datail").append(young);
				//console.log(young);
				//var datos = talento.split('|');
				$('#up-tal-input').val(talento);
				console.log(talento)
				//console.log($("#tal option[value="+datos[10]+"]").attr("selected",true));
				//console.log(datos[10]);
			},
			error:function(talento)
			{
				//$("#usr-rol-input").html(mun);
				console.log(talento);
			}
	});
	$('#update-tal').on('click',updatal);

}
function updatal()
{
	var talento = getUrlVars()["talento"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '58'+'&id='+talento+'&talento='+$('#up-tal-input').val(),
			success:function(talento)
			{
				if(talento == '1')
				{
					$('#noti-tal-update p').html('Se ha actualizado el talento.');
				}
				else
					$('#noti-tal-update p').html('Error al actualizar.');
			},
			error:function(talento)
			{
				//$("#usr-rol-input").html(mun);
				console.log(talento);
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