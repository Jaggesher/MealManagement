<?php

	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
		$userID=$_SESSION['ID'];
		$memID=$_POST["memID"];
		$action=$_POST["action"];
		$tm="member".$userID;
		include 'dbconnect.php';
		if($action=="ac"){
			$sql="SELECT ST FROM account WHERE ID= ".$memID;
			$result = $conn->query($sql);
			if($result->num_rows>0){
				$row=$result->fetch_array();
				if($row['ST']=="none"){
					$sql="UPDATE account SET ST='member', ManagerID=".$userID." WHERE ID=".$memID;
					if($conn->query($sql)===TRUE){
						$sql="UPDATE ".$tm." set Type='member' where ID=".$memID;
						if($conn->query($sql)===TRUE){
							$tm1="meal".$userID;
							$tm2="A".$memID;
							$sql="ALTER TABLE ".$tm1." ADD ".$tm2." Float NOT NULL DEFAULT 0";
							if($conn->query($sql)===TRUE){
								echo "OK";
							}
							else{
								echo "Error JG 4: ".$conn->error;
							}
						}
						else{
							echo "Error JG 3: ".$conn->error;
						}

					}
					else{
						echo "Error JG 2: ".$conn->error;
					}
				}
				else{
					$sql="DELETE FROM ".$tm." where ID=".$memID;
					$conn->query($sql);
					echo "Already Member In Other Group.";
				}
			}

		}
		else if($action=="Rc"){
			echo "ASSE ";
			$sql="DELETE FROM ".$tm." where ID=".$memID;
			if($conn->query($sql)===TRUE){
	  		echo "OK";
	  		}
	  		else{
	  			echo "Error JG: ".$conn->error;
	  		}
		}
		$conn->close();
	}else{
    echo "You Are Not Logged In";
  }
?>