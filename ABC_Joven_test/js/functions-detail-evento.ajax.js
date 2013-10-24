$(document).on('ready',inicio());

function inicio()
{
	
	var evento = getUrlVars()["evento"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '44'+'&evento='+evento,
			success:function(evento)
			{
				$("#page-datail").html(evento);
				//console.log(evento)
				
			},
			error:function(evento)
			{
				//$("#usr-rol-input").html(mun);
				console.log(evento)
				
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
