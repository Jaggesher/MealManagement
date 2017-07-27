$(document).ready(function(){
	$("#SendReq").click(function(){
		var ID= $("#SendReq").val();
		$.post( "sendReq.php",
    			{ID: ID},
    			function(data) {
    				alert(data);
    				$("#SendReq").hide();
            	});
	});
});