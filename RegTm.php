<?php
	$email= $_POST["userEmail"];
	$pswrd= $_POST["userPassword"];
	$name=$_POST['userName'];
	$birthdate= date("m/d/Y", strtotime($_POST["birthdate"]));
	$dateObj = DateTime::createFromFormat('m/d/Y', $birthdate);
	$birthdate = $dateObj->format('Y/m/d');
	$gender= $_POST["Gender"];
	$phn= $_POST["usermobile"];

	include 'dbconnect.php';

	$sql = "SELECT COUNT(*)as total FROM account";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$row_array=$result->fetch_array();
		$LatID=$row_array['total']+1;
		$sql="INSERT INTO account(ID,Email,Pass,Name,Birth,Mobile,Gender,Pro,ST)
		 VALUES('$LatID','$email','$pswrd','$name','$birthdate','$phn','$gender','pro.jpg','none')";
		if($conn->query($sql)===TRUE){
			$tm='chat'.$LatID;
			$sql="create table ".$tm."(
				MsgID int AUTO_INCREMENT primary key,
				ID int not null,
				Msg varchar(105) not null,
				Dat Date not null,
				FOREIGN KEY (ID) REFERENCES account(ID))";
			if($conn->query($sql)===TRUE){
				$tm='bal'.$LatID;
				$sql="create table ".$tm."(
					Dat date primary key,
					Amount int not null)";
				if($conn->query($sql)===TRUE){

					session_start();
					$_SESSION["ID"] = $LatID;
					$_SESSION["MG"]="";
					$_SESSION["STUS"]="none";
					header('location:member.php');
				}
				else{
					echo "Error_RG-4" . $conn->error;
				}
			}
			else
			{
				echo "Error_RG-3" . $conn->error;
			}
		}
		else{
			echo "Error_RG-2" . $conn->error;
		}
	}
	else
	{
		echo "Error_RG-1 =" . $conn->error;
	}

	$conn->close();
?>