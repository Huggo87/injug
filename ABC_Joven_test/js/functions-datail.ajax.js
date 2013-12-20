$(document).on('ready',inicio());

function inicio()
{
	
	var young = getUrlVars()["young"];
	$.ajax({
			type:"POST",
			url:"../test.php",
			data:'caso=' + '27'+'&joven='+young,
			success:function(young)
			{
				$("#page-datail").html(young);
				//console.log(young)
				
			},
			error:function(young)
			{
				//$("#usr-rol-input").html(mun);
				console.log(young)
				
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
