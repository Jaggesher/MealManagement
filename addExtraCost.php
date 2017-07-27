<?php
  session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    $userID=$_SESSION['ID'];
    $amount=$_POST['amount'];

    include 'dbconnect.php';
      include 'serverDate.php';
      $tm="ext".$userID;
      $sql="INSERT INTO ".$tm." VALUES('$curDate','$amount')";
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