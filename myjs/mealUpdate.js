$(document).ready(function(){
	$("#MLCbtn").click(function(){
    	var amount=$("#MLCamount").val();
		var memID=$('#MMeID option:selected').val();
		var Dat=$('#MDtID option:selected').val();
		if(amount!="" && Dat!=""){
			$.post( "mealUpdate.php",
	    			{memID: memID, amount: amount,Dat: Dat},
	    			function(data) {
	    				if(data="OK"){
    					$.post( "AddMealMem.php",
		                {memID: memID},
		                function(data) {
		                    $("#MuContent").html(data);
		                },"html");
    				}
    				else{
    					alert(data);
    				}
	    		});
		}
		else{
			alert("Please Fill All Information.");
		}
    });	
});