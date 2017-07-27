$(document).ready(function(){
	$("#BLADD").click(function(){
		var amount=$("#BLAtodayAmount").val();
		var memID=$('#BMeID option:selected').val();
		if(amount!="")
		{
			$.post( "addBlns.php",
    			{memID: memID, amount: amount},
    			function(data) {
    				if(data="OK"){
    					$.post( "AddBlnsMem.php",
		    			{memID: memID},
		    			function(data) {
		    				$("#BuContent").html(data);
		            	},"html");
    				}
    				else{
    					alert(data);
    				}
            	});
		}
		else{
			alert("Please Fill Amount.");
		}	
    });

    $("#BLCbtn").click(function(){
    	var amount=$("#BLCamount").val();
		var memID=$('#BMeID option:selected').val();
		var Dat=$('#BDtID option:selected').val();

		if(amount!="" && Dat!=""){
			$.post( "updateBlns.php",
	    			{memID: memID, amount: amount,Dat: Dat},
	    			function(data) {
	    				if(data="OK"){
    					$.post( "AddBlnsMem.php",
		    			{memID: memID},
		    			function(data) {
		    				$("#BuContent").html(data);
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