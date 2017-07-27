<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
	$Dat= date("Y/m/d", strtotime($_POST["Dat"]));
	$Ntc=$_POST["Ntc"];
	// session
	$userID=$_SESSION['ID'];
	// session
	include 'dbconnect.php';
	include 'serverDate.php';
	$tm="ntc".$userID;
	$sql="INSERT INTO ".$tm."(Gdate,Msg,Till) VALUES('$curDate','$Ntc','$Dat')";
	if($conn->query($sql)===TRUE){
		echo "DONE";
	}
	else{
		echo "Error_ADN-1 =" . $conn->error;
	}
	$conn->close();
	}
	else{
		echo "You Are Not Logged In";
	}
?>
