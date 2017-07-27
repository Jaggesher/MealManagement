<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){
    $userID=$_SESSION['ID'];

    include 'dbconnect.php';
    $tm="member".$userID;
    $datArray=array();
    $idArray=array();
    $sql="SELECT DISTINCT account.ID as ID, Email, Mobile, Name FROM account 
    INNER JOIN ".$tm." ON account.ID = ".$tm.".ID AND ".$tm.".Type='join'";
    $result = $conn->query($sql);
    echo '<script src="myjs/join.js"></script>';
    echo'
      <table class="container clstbl">
        <thead>
            <tr>
              <th><h1>Email</h1></th>
        <th><h1>Name</h1></th>
              <th><h1>Phon:</h1></th>
            </tr>
        </thead>
        <tbody> ';

        if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                  $datArray[]=$row['Email'];
                  $idArray[]=$row['ID'];

                  echo '<tr><td>'.$row['Email'].'</td> <td>'.$row['Name'].'</td> <td>'.$row['Mobile'].'</td></tr>';
                }
          }
          else{
            echo '<tr>
                    <td>No Entrey</td>
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
          <h3 style="color:#FB667A;">ACTION.</h3>
          <div class="col-sm-12 form-group">
            <select  id="JoinPtID" class="form-control">
              <option value="" disabled selected hidden>Select A Member.</option>
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

          <div class="col-sm-12 form-group">
              <button id="JoAcbtn" type="button" class="btn btn-primary pull-left">Accept <span class="glyphicon glyphicon-ok-sign"></span></button>
              <button id="JoRjbtn" type="button" class="btn btn-primary pull-right">Remove <span class="glyphicon glyphicon-remove-sign"></span></button>
          </div> 
      </div>
    ';


    $conn->close();
  }
  else{
    echo "You Are Not Logged In";
  }
?>