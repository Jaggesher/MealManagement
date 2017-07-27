<?php
  session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
      $userID=$_POST["grpID"];
      $memID=$_SESSION["ID"];
      include 'dbconnect.php';
      $sql="SELECT * FROM manager WHERE ID =".$userID;
      $result = $conn->query($sql);
      $row=$result->fetch_array();
      echo '<script src="myjs/findg.js"></script>';
      echo '<div class="col-sm-8">
      <div class="form-group">
        <label for="FGname" style="color:#FB667A;">Group Name:</label>
        <input type="text" class="form-control" id="FGname" readonly value="'.$row['Name'].'">
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
          <label for="FGfxamount" style="color:#FB667A;">Fixed Cost:</label>
          <input type="text" class="form-control" id="FGfxamount" readonly value="'.$row['Fix'].'">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
          <label for="FGabout" style="color:#FB667A;">About:</label>
          <textarea class="form-control" style="resize:none;" rows="10" id="FGabout" readonly>'.$row['About'].'</textarea>
        </div>
    </div>
    ';

    if($_SESSION["STUS"]=='none'){
      $tm="member".$userID;
      $sql ="SELECT * from ".$tm." WHERE ID=".$memID;
      $result = $conn->query($sql);
      if($result->num_rows <= 0)
      {
        echo '
        <div class="col-sm-12">
            <button id="SendReq" type="button" class="btn btn-primary" value="'.$userID.'">Send Member Request <span class="glyphicon glyphicon-ok-sign"></span></button>
        </div>';
      }
    }

    $conn->close();
    }else{
      echo "You Are Not Logged In";
    }


?>


