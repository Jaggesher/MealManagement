<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
		$userID=$_SESSION['ID'];
		$memID=$_POST["memID"];
		$amount=$_POST["amount"];
		$Dat=$_POST["Dat"];
		include 'dbconnect.php';

		$tm1="A".$memID;
		$tm2="meal".$userID;

		$sql="UPDATE ".$tm2." SET ".$tm1."= ".$amount." WHERE ID= ".$Dat;
		if($conn->query($sql)===TRUE){
	  		echo "OK";
	  	}
	  	else{
	  		echo "Error AD: ".$conn->error;
	  	}
	  	$conn->close();
	}else{
    echo "You Are Not Logged In";
  }
?>