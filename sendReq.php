<?php
session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    	$userID=$_POST["ID"];
    	$memID=$_SESSION["ID"];
    	include 'dbconnect.php';
    	$tm="member".$userID;
    	$sql="INSERT INTO ".$tm." (ID,Type) VALUES(".$memID.",'join')";
    	if($conn->query($sql)===TRUE){
    		echo "Request Send";
    	}
    	else{
    		echo $conn->error;
    	}
    	$conn->close();
    }
    else{
    	echo "You Are Not Logged IN";
    }
?>