$(document).on('ready',inicio());

function inicio()
{
	
	var user = getUrlVars()["user"];
	$.ajax({
			type:"POST",
			url:"test.php",
			data:'caso=' + '32'+'&user='+user,
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
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
