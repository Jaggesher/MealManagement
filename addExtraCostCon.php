<?php

  session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    $userID=$_SESSION['ID'];
    $meldate=array();
    $todayIN='NO';
    include 'dbconnect.php';
    include 'serverDate.php';

    $tm="ext".$userID;

    $sql="SELECT * FROM ".$tm;
    $result = $conn->query($sql);

    echo '<script src="myjs/exUpdate.js"></script>';
    echo'
      <h2  style="color:#FB667A;">#ExtraCost Information.</h2>
      <table class="container clstbl">
        <thead>
            <tr>
                <th><h1>Date</h1></th>
                <th><h1>Amount(.tk)</h1></th>
            </tr>
        </thead>
        <tbody> ';

        if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                  $meldate[]=$row['Dat'];
                  if($curDate==$row['Dat']){
                    $todayIN="YES";
                  }
                  echo '<tr><td>'.$row['Dat'].'</td> <td>'.$row['Amount'].'</td></tr>';
                }
          }
          else{
            echo '<tr>
                    <td>Y/M/D</td>
                    <td>No Entrey</td>
                  </tr>';
          }

    echo '  
        </tbody>
      </table>
      </br>
    ';
      if($todayIN!="YES"){

        echo '  
      <div class="input-group" id="EXtodayAmountDiv">
          <input  type="text" id="EXtodayAmount" class="form-control input-sm clsinpt" placeholder="Enter Amount..." onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" />
          <span class="input-group-btn">
              <button class="btn btn-warning btn-sm clsgo" id="EXADD" >
              <span class="glyphicon glyphicon-plus lighter"></span></button>
          </span>
      </div>
    ';
    }
    
    echo '
      <div class="row mdl_edit text-center">
          <h3 style="color:#FB667A;">EDIT INFO.</h3>
          <div class="col-sm-6 form-group">
            <select  id="EXtID" class="form-control">
              <option value="" disabled selected hidden>Select A Date.</option>
    ';

            $arrlength = count($meldate);
            if($arrlength>0)
            {
              for($x = 0; $x < $arrlength; $x++) {
                echo'<option style="color: black" value="'.$meldate[$x].'">'.$meldate[$x].'</option>';
              }
            }
            else{
              echo'<option style="color: black" value="">No Record</option>';
            }

    echo '        
            </select>
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" type="text" id="EXCamount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="4" required>
          </div>

          <div class="col-sm-12 form-group">
              <button id="EXbtn" type="button" class="btn btn-primary">OK <span class="glyphicon glyphicon-ok"></span></button>
          </div> 
      </div>
    ';

    $conn->close();
  }else{
    echo "You Are Not Logged In";
  }
?>