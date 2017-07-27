<?php
    session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    $memID=$_POST['memID'];
    $userID=$_SESSION['ID'];
    include 'dbconnect.php';
    $tem1="mealdate".$userID;
    $tem2="meal".$userID;
    $tem3="A".$memID;
    $datArray=array();
    $idArray=array();
    $sql="SELECT ".$tem1.".ID as ID, ".$tem1.".Mdate as Dat, ".$tem1."
    .Amount as rate, ".$tem2.".".$tem3." as meal "."
    from ".$tem1." INNER JOIN ".$tem2 ." ON ".$tem1.".ID = ".$tem2.".ID";

    $result = $conn->query($sql);
    
    echo '<script src="myjs/mealUpdate.js"></script>';
    echo'
      <h2  style="color:#FB667A;">#Meal Information.</h2>
      <table class="container clstbl">
        <thead>
            <tr>
                <th><h1>Date</h1></th>
                <th><h1>Amount</h1></th>
                <th><h1>Rate</h1></th>
            </tr>
        </thead>
        <tbody> ';

        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
                  $datArray[]=$row['Dat'];
                  $idArray[]=$row['ID'];

                  echo '<tr><td>'.$row['Dat'].'</td> <td>'.$row['meal'].'</td> <td>'.$row['rate'].'</td></tr>';
                }
    }
    else{
      echo '<tr>
                    <td>Y/M/D</td>
                    <td>No Entrey</td>
                    <td>No Entrey</td>
                  </tr>';
    }

     echo '  
        </tbody>
      </table>
      </br>
    ';

    echo '
      <div class="row mdl_edit text-center">
          <h3 style="color:#FB667A;">EDIT INFO.</h3>
          <div class="col-sm-6 form-group">
            <select  id="MDtID" class="form-control">
              <option value="" disabled selected hidden>Select A Date.</option>
    ';

            $arrlength = count($datArray);
            if($arrlength>0)
            {
              for($x = 0; $x < $arrlength; $x++) {
                echo'<option style="color: black" value="'.$idArray[$x].'">'.$datArray[$x].'</option>';
              }
            }
            else{
              echo'<option style="color: black" value="">No Record</option>';
            }

    echo '        
            </select>
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" type="text" id="MLCamount" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" required>
          </div>

          <div class="col-sm-12 form-group">
              <button id="MLCbtn" type="button" class="btn btn-primary">OK <span class="glyphicon glyphicon-ok"></span></button>
          </div> 
      </div>
    ';

    $conn->close();
  }
  else{
    echo "You Are Not Logged In";
  }
?>