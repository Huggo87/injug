$(document).on('ready',inicio());

function inicio()
{
	var seg = getUrlVars()["segmento"];
	// console.log(seg);
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '55'+'&segmento='+seg,
			success:function(seg)
			{
				//$("#page-datail").append(young);
				//console.log(young);
				//var datos = seg.split('|');
				$('#up-seg-input').val(seg);
				//console.log(seg)
				//console.log($("#edo option[value="+datos[10]+"]").attr("selected",true));
				//console.log(datos[10]);
			},
			error:function(seg)
			{
				//$("#usr-rol-input").html(mun);
				console.log(seg);
			}
	});
	$('#update-seg').on('click',updseg);

}
function updseg()
{
	var seg = getUrlVars()["segmento"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '56'+'&id='+seg+'&segmento='+$('#up-seg-input').val(),
			success:function(seg)
			{
				if(seg == '1')
				{
					$('#noti-seg-update p').html('Se ha actualizado el segmento.');
				}
				else
					$('#noti-seg-update p').html('Error al actualizar.');
			},
			error:function(seg)
			{
				//$("#usr-rol-input").html(mun);
				console.log(seg);
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