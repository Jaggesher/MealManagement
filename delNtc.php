<?php
  session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    $userID=$_SESSION['ID'];
    $ID=$_POST['ID'];

    include 'dbconnect.php';

	  $tm="ntc".$userID;
	  $sql="DELETE FROM ".$tm." WHERE NtcID= '".$ID."'";
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