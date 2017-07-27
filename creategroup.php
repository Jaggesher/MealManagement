<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
	$userID=$_SESSION["ID"];
	$name=$_POST["name"];
	$cost=$_POST["cost"];
	$about=$_POST["about"];
	
	include 'dbconnect.php';
	$sql="INSERT INTO manager(ID,Name,About,Fix) values('$userID','$name','$about','$cost')";
	if($conn->query($sql)===TRUE){
		$tm="ntc".$userID;
		$sql="create table ".$tm."(
			NtcID int AUTO_INCREMENT primary key,
			Gdate date not null,
			Msg varchar(1500) not null,
			Till date not null)";
		if($conn->query($sql)===TRUE){
			$tm="mealdate".$userID;
			$sql="create table ".$tm."(
			ID int primary key,
			Mdate date not null unique,
			Amount Float not null)";
			if($conn->query($sql)===TRUE){
				$tm="member".$userID;
				$sql="CREATE TABLE ".$tm."(
					    ID int PRIMARY KEY,
					    Type varchar(10) not null,
					    Meal Float not null,
					    FOREIGN KEY (ID) REFERENCES account(ID),
					    FOREIGN KEY (Type) REFERENCES reqtype(Type)
					)";
				if($conn->query($sql)===TRUE){
					$tm1="meal".$userID;
					$tm2="mealdate".$userID;
					$sql="CREATE TABLE ".$tm1."(
						    ID int PRIMARY KEY,
						    FOREIGN KEY(ID) REFERENCES ".$tm2."(ID))";
					if($conn->query($sql)===TRUE){
						$tm="ext".$userID;
						$sql="CREATE table ".$tm."(
						    Dat date primary key,
						    Amount Float not null)";
						if($conn->query($sql)===TRUE){
							$sql="UPDATE account 
							set ST="."'manager'".", ManagerID=".$userID."
							 where ID=".$userID;
							if($conn->query($sql)===TRUE){
								$tm="member".$userID;
								$sql="INSERT into ".$tm." VALUES('$userID','member',0)";
								if($conn->query($sql)===TRUE){
									$tm1="meal".$userID;
									$tm2="A".$userID;
									$sql="ALTER TABLE ".$tm1." ADD ".$tm2." Float NOT NULL DEFAULT 0";
									if($conn->query($sql)===TRUE){
										echo "OK";
										 $_SESSION["ID"] = $userID;
										 $_SESSION["MG"] = $userID;
										 $_SESSION["STUS"]="manager";
									}
									else{
										echo "Error_CG 9=" . $conn->error;
									}
								}else{
									echo "Error_CG 8=" . $conn->error;
								}
							}
							else{
								echo "Error_CG 7=" . $conn->error;
							}
						}
						else{
							echo "Error_CG 6=" . $conn->error;
						}
					}
					else{
						echo "Error_CG 5=" . $conn->error;
					}
				}
				else{
					echo "Error_CG 4=" . $conn->error;
				}
			}
			else{
				echo "Error_CG 3=" . $conn->error;
			}

		}
		else{
			echo "Error_CG 2=" . $conn->error;
		}
	}
	else{
		echo "Error_CG 1=" . $conn->error;
	}
	$conn->close();
}
else{
	echo "You are Not Logged IN";
}
?>



