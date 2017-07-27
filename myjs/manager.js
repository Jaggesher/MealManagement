$(document).ready(function(){
	$("#ANTbtn").click(function(){
		var Dat=$("#ANtdate").val();
		var Ntc=$("#ANtmsg").val();
		if(Dat!="" && Ntc!=""){
			$.post(
				"addNotice.php",
				{Dat: Dat,Ntc: Ntc},
				function(data){
					alert(data);
					$("#ANtdate").val("");
					$("#ANtmsg").val("");
				});
		}
		else{
			alert("Please Fill All Info");
		}
    });

    $("#BMeID").change(function(){
    	var memID=$('#BMeID option:selected').val();
    	if(memID!=""){
    		//$("#BuContent").load("AddBlnsMem.php",{memID: memID});
    		$.post( "AddBlnsMem.php",
    			{memID: memID},
    			function(data) {
    				$("#BuContent").html(data);
            	},"html");
    	}
    	else{
    		alert("Please Select a Person.");
    	}
    	
    });
    
    $("#MMeID").change(function(){
    	var memID=$('#MMeID option:selected').val();
        if(memID!=""){
            //$("#BuContent").load("AddBlnsMem.php",{memID: memID});
            $.post( "AddMealMem.php",
                {memID: memID},
                function(data) {
                    $("#MuContent").html(data);
                },"html");
        }
        else{
            alert("Please Select a Person.");
        }
    });

    $.post( "addExtraCostCon.php",
        function(data) {
            $("#ExContent").html(data);
        },"html");

    $.post( "joinGoupContent.php",
        function(data) {
            $("#JoinContent").html(data);
        },"html");
    
    $("#cmConfirm").click(function(){
        var Dat=$("#cmdate").val();
        var Amount=$("#cmcost").val();
        if(Dat!="" && Amount!=""){
            $.post("comealContent.php",
                {Dat: Dat, Amount: Amount},
                function(data) {
                    if(data=="OK"){
                        $("#cmdate").val("");
                        $("#cmcost").val("");
                        $("#Lastcmcost").val(Amount);
                        $("#lastcmdate").val(Dat);
                    }
                    else{
                        alert(data);
                    }
                });
        }else{
            alert("Please Fill All Information.");
        }
    });

    $("#CloseGroup").click(function(){
        $.post("closeIt.php",function(data){
            alert(data);
            window.location.replace("index.php");
        });
    });

    $(document).on('click', '.browse', function(){
          var file = $(this).parent().parent().parent().find('.file');
          file.trigger('click');
        });
        $(document).on('change', '.file', function(){
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });


        $("#Half").click(function(){
        var tm= parseFloat($("#MLamount").val())+.5;
        $("#MLamount").val(tm);
        });
        $("#Zero").click(function(){
            $("#MLamount").val(0);
        });
        $("#Full").click(function(){
            var tm= parseFloat($("#MLamount").val())+1;
            $("#MLamount").val(tm);
        });
        $("#CHbtn").click(function(){
            var tm= $("#MLamount").val();
            $.post( 
                "membermeal.php",
                { amount:tm},
                function(data) {
                   alert(data);
                });
        });

        $("#notice").find("button").click(function(){
            var ID=$(this).val();
            $.post(
                "delNtc.php",
                {ID: ID},
                function(data){
                    if(data=="OK"){
                        location.reload();
                    }
                    else{
                        alert(data);
                    }
            });
        });
});
