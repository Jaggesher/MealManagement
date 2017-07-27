<?php
	
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
		$userID=$_SESSION["MG"];
		$memberID=$_SESSION["ID"];
		$amount=$_POST["amount"];
		include 'dbconnect.php';
		$tm="member".$userID;
		$sql="UPDATE ".$tm." SET Meal=".$amount." WHERE ID=".$memberID;
		if($conn->query($sql)===TRUE){
	  		echo "Done";
	  	}
	  	else{
	  		echo "Error MU: ".$conn->error;
	  	}
	  }else{
	  	echo "You Are Not Logged In.";
	  }
	$conn->close();
?>