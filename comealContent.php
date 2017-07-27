<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    	$userID=$_SESSION['ID'];
    	$Dat=$_POST['Dat'];
    	$Amount=$_POST['Amount'];
    	include 'dbconnect.php';
    	$tm="mealdate".$userID;
    	$sql="SELECT count(*) as total FROM ".$tm;
    	$result = $conn->query($sql);
		if($result->num_rows > 0)
		{
			$row_array=$result->fetch_array();
			$LatID=$row_array['total']+1;
			$sql="INSERT INTO ".$tm." VALUES('$LatID','$Dat','$Amount')";
			if($conn->query($sql)===TRUE){
				$tm1="member".$userID;
				$sql1="SELECT ID, Meal FROM ".$tm1." WHERE Type= 'member'";
				$result = $conn->query($sql1);
				if($result->num_rows > 0){
					$tm="meal".$userID;
					$Flag=1;
					$sql="INSERT into ".$tm."(ID) VALUES('$LatID')";
					$conn->query($sql);
					while($row = $result->fetch_assoc()) {
						$tm1="A".$row["ID"];
						$sql="UPDATE ".$tm." SET ".$tm1."=".$row["Meal"]." WHERE ID=".$LatID;
						if($conn->query($sql)===FALSE){
							$Flag=0;
						}	
                    }
                    if($Flag==1){
                    	echo "OK";
                    }
                    else{
                    	echo "Error_CMU-4 =" . $conn->error;
                    }
				}
				else{
					echo "Error_CMU-3 =" . $conn->error;
				}
			}
			else{
				echo "Error_CMU-2 =" . $conn->error;
			}
		}
    	else{
    		echo "Error_CMU-1 =" . $conn->error;
    	}

    	$conn->close();
    }
    else{
    	echo "You Are Not Logged In";
    }
?>