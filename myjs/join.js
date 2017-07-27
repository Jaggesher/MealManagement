$(document).ready(function(){
	$("#JoAcbtn").click(function(){
		var memID=$('#JoinPtID option:selected').val();
		if(memID!=""){
			$.post( "joinGoup.php",
    			{memID: memID, action: "ac"},
    			function(data) {
    				if(data="OK"){
    					$.post( "joinGoupContent.php",
				        function(data) {
				            $("#JoinContent").html(data);
				        },"html");
    				}
    				else{
    					alert(data);
    				}
            	});

		}
		else{
			alert("Please Fill All Info");
		}
	});
	$("#JoRjbtn").click(function(){
		var memID=$('#JoinPtID option:selected').val();
		if(memID!=""){
			$.post( "joinGoup.php",
    			{memID: memID, action: "Rc"},
    			function(data) {
    				if(data="OK"){
    					$.post( "joinGoupContent.php",
				        function(data) {
				            $("#JoinContent").html(data);
				        },"html");
				    }
    				else{
    					alert(data);
    				}
            	});

		}
		else{
			alert("Please Fill All Info");
		}
	});
});