$(document).ready(function(){
	$("#EXADD").click(function(){
		var amount=$("#EXtodayAmount").val();
		if(amount!="")
		{
			$.post( "addExtraCost.php",
    			{amount: amount},
    			function(data) {
    				if(data="OK"){
    					$.post( "addExtraCostCon.php",
				        function(data) {
				            $("#ExContent").html(data);
				        },"html");
    				}
    				else{
    					alert(data);
    				}
            	});
		}
		else{
			alert("Please Fill Amount. HI");
		}	
    });

    $("#EXbtn").click(function(){
    	var amount=$("#EXCamount").val();
		var Dat=$('#EXtID option:selected').val();
		if(amount!="" && Dat!=""){
			$.post( "updateExtraCost.php",
	    			{amount: amount,Dat: Dat},
	    			function(data) {
	    				if(data="OK"){
    					$.post( "addExtraCostCon.php",
				        function(data) {
				            $("#ExContent").html(data);
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