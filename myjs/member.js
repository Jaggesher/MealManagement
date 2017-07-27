$(document).ready(function(){
	$("#CGbtn").click(function(){
		var Name=$("#Gname").val();
		var FxCost=$("#fxamount").val();
		var About=$("#Gabout").val();
		if(Name!=""&& FxCost!="" && About!="")
		{
			$.post( 
            "creategroup.php",
            { name: Name, cost: FxCost, about: About},
            function(data) {
               alert(data);
               window.location.replace("manager.php");
            });
    	}
    	else{
    		alert("Please Fill All Info.");
    	}
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

    $("#FindGrpID").change(function(){
        var grpID=$('#FindGrpID option:selected').val();
        if(grpID!=""){
            $.post( 
            "findGroupAdd.php",
            { grpID: grpID},
            function(data) {
               $("#FindGroupCont").html(data);
            },'html');
        }else{
            alert("Please Fill All Info");
        }
        
    });

    $(document).on('click', '.browse', function(){
          var file = $(this).parent().parent().parent().find('.file');
          file.trigger('click');
        });
        $(document).on('change', '.file', function(){
        $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
});