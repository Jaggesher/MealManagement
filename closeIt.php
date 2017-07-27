<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'] && $_SESSION['STUS']=="manager")){
    		$userID=$_SESSION["ID"];
    		include 'dbconnect.php';

    		  $sql="DELETE FROM manager WHERE ID=".$userID;
    		  $conn->query($sql);


    		  $tm="meal".$userID;
		      $sql="DROP TABLE ".$tm;
		      $conn->query($sql);
		      // echo "meal".$conn->error."</br>";

    		  $tm="mealdate".$userID;
		      $sql="DROP TABLE ".$tm;
		      $conn->query($sql);
		      // echo "mealdate".$conn->error."</br>";


		      $tm="ext".$userID;
		      $sql="DROP TABLE ".$tm;
		      $conn->query($sql);
		      // echo "ext".$conn->error."</br>";

		      $tm="ntc".$userID;
		      $sql="DROP TABLE ".$tm;
		      $conn->query($sql);
		      // echo "ntc".$conn->error."</br>";

		      $tm="member".$userID;
		      $sql="SELECT ID FROM ".$tm." WHERE Type='member'";
		      $result = $conn->query($sql);
		      // echo "member".$conn->error."</br>";

		      while($row = $result->fetch_assoc()) {
		      		$tm=$row["ID"];
		      		$sql="UPDATE account SET ST='none' WHERE ID=".$tm;
		      		$conn->query($sql);
		      		// echo "account".$conn->error."</br>";

		      		$tm1='bal'.$tm;
		      		$sql="DELETE FROM ".$tm1;
		      		$conn->query($sql);
		      		// echo "bal".$conn->error."</br>";

	        	}


		      $tm="member".$userID;
		      $sql="DROP TABLE ".$tm;
		      $conn->query($sql);
		      // echo "member".$conn->error."</br>";
		      echo "DONE";

		      session_destroy();
		      $conn->close();

    	}else{
    		echo "You are Not Logged IN.";
    	}
?>