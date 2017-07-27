<?php

	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
		$userID=$_SESSION['ID'];
		$amount=$_POST["amount"];
		$Dat=$_POST["Dat"];
		include 'dbconnect.php';
		$tm="ext".$userID;

		$sql="UPDATE ".$tm." SET Amount = ".$amount." WHERE Dat='".$Dat."'";
		if($conn->query($sql)===TRUE){
	  		echo "OK";
	  	}
	  	else{
	  		echo "Error UpD: ".$conn->error;
	  	}
		$conn->close();

	}else{
		echo "You Are Not Logged In";
	}
?>
