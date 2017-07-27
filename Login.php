<?php
	$email= $_POST['userEmail'];
	$pswrd= $_POST['usurePassword'];

	include 'dbconnect.php';

	$sql="SELECT ID,ST,ManagerID FROM account where Email='".$email."' AND Pass='".$pswrd."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{

		$row_array=$result->fetch_array();
		 session_start();
		 $_SESSION["ID"] = $row_array["ID"];
		 $_SESSION["MG"] = $row_array["ManagerID"];
		 $_SESSION["STUS"]=$row_array["ST"];
		 // if($row_array["ST"]=="none" || $row_array["ST"]=="member"){
		 // 	$_SESSION["STUS"]="member";
		 	header('location:member.php');
		 // }
		 // else if($row_array["ST"]=="manager"){
		 // 	$_SESSION["STUS"]="manager";
		 // 	header('location:manager.php');
		 // }
	}
	else{
		header('location:index.php');
	}
	
	$conn->close();
?>