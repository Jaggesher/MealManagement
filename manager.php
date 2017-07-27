<?php

    session_start();

    if(!isset($_SESSION["ID"]) || $_SESSION["ID"]==""){
        header('location:index.php');
    }
    else if(isset($_SESSION["STUS"]) && ($_SESSION["STUS"]=="memeber"||$_SESSION["STUS"]=="none")){
        $_SESSION["ID"]="";
        header('location:memeber.php');
    }
    $userID=$_SESSION["MG"];
    $memID=$_SESSION["ID"];
    include 'dbconnect.php';
    $AllMemberID=array();
    $AllMemberName=array();
    $AllMemberMeal=array();
    $tm="member".$userID;
    $sql="SELECT account.ID as ID, account.Name as Name,".$tm.".Meal as Meal from account INNER JOIN ".$tm." ON account.ID=".$tm.".ID AND ".$tm.".Type='member'";
    $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $AllMemberName[]=$row["Name"];
            $AllMemberID[]=$row["ID"];
            $AllMemberMeal[]=$row["Meal"];
        }
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Online Meal Management</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="mycss/manager.css"/>
        <script src="myjs/manager.js"></script>
  </head>

  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
         <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#myPage">HOME</a>
         </div>
         <div class="collapse navbar-collapse" id="myNavbar">
           <ul class="nav navbar-nav navbar-right">
            <li><a href="#profile">PROFILE</a></li>
            <li><a href="#notice">NOTICE</a></li>
            <li><a href="#status">STATUS</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">UPDATE
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" data-toggle="modal" data-target="#AddNotice">Add Notice</a></li>
                <li><a href="#" data-toggle="modal" data-target="#Common_Meal">Common Meal</a></li>
                <li><a href="#" data-toggle="modal" data-target="#Balance_Update">Balance Update</a></li>
                <li><a href="#" data-toggle="modal" data-target="#Meal_Update">Meal Update</a></li>
                <li><a href="#" data-toggle="modal" data-target="#Extra_Cost_Update">Extra Cost</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" data-toggle="modal" data-target="#mem_req">Join Request</a></li>
                <li><a href="#" data-toggle="modal" data-target="#MealStatus">My Meal</a></li>
                <li><a href="#" data-toggle="modal" data-target="#ClogGroup">Close Your Group.</a></li>
                <li><a href="#" data-toggle="modal" data-target="#UpdateProfile">Update Profile</a></li>
              </ul>
            </li>
            <li><a href="loout.php" data-toggle="tooltip" data-placement="bottom" title="Log Out"><span class="glyphicon glyphicon-log-out">  </span></a></li>
           </ul>
         </div>
      </div>
    </nav>
    <!-- This Is Back Ground Crousal for Profile-->
    <header id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('pic/1.jpg');"></div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('pic/2.jpg');"></div>
            </div>

            <div class="item">
                <div class="fill" style="background-image:url('pic/3.jpg');"></div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('pic/4.jpg');"></div>
            </div>
        </div>
    </header>

    <div class="cls1"> <!-- This div Containing Whole thing-->
        <div id="profile" class="container-fluid text-center cls2"><!-- This Is Profile Div-->
            </br>
            </br>
            <?php
                $sql="SELECT Email,Name,Birth,Mobile,Gender,Pro FROM account WHERE ID=".$memID;
                $result = $conn->query($sql);
                if($result->num_rows > 0)
                {
                    $result=$result->fetch_array();
                    $ProPic=$result["Pro"];
                    if($userID!=""){
                        $sql="SELECT Name,Fix FROM manager WHERE ID=".$userID;
                        $result2=$conn->query($sql);
                        $result2=$result2->fetch_array();
                        $grp=$result2['Name'];
                    }
                    else{
                        $grp="Not Available";
                    }
                }
                else{
                    header('location:index.php');
                }
                ?>
            <div class="col-sm-12">
              <img id="propic"src="<?php echo $result["Pro"];?>" class="img-circle" alt="User" width="220" height="220">
            </div>
            <h1><?php echo $result["Name"];?></h1>
            <h2><?php echo $result["Email"];?></h2>
            <h2><?php echo $result["Birth"];?></h2>
            <p><strong>Gender: </strong><?php echo $result["Gender"];?></p>
            <p><strong>Mobile: </strong><?php echo $result["Mobile"];?></p>
            <p><strong>Group: </strong><?php echo $grp."(".$_SESSION["STUS"].")";?></p>
        </div> <!-- here End Of Profile -->

        <div id="notice" class="cls3"><!-- This Is Notice Div-->
            <div  class="container text-center">
                <h1>NOTICE</h1>
                <p><em>All Available Notice Are Below.</em></p>

                <?php

                        if($userID!=""){
                            $tm="ntc".$userID;
                            $sql="SELECT * FROM ".$tm." ORDER BY NtcID DESC";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()) {
                                    echo '
                                    <div class="container-fluid text-center cls_ntc slideanim">
                                        <button type="button" class="btn btn-default btn-sm pull-right ntc_btn" data-toggle="tooltip" data-placement="bottom" title="Remove" value="'.$row["NtcID"].'">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button><br>
                                        <p>'.$row["Msg"].'</p>
                                        </br>
                                        <div class="col-sm-6 text-left" style="color:#FB667A;">
                                            </br>
                                            </br>
                                            <h4>Till:</h4>
                                            <h4>Date: '.$row["Till"].'</h4>
                                        </div>
                                        <div class="col-sm-6" style="color:#FB667A;">
                                            <p align="right">Given By</p>
                                            <img id="mpro"src="'.$ProPic.'" class="img-circle" alt="User" width="60" height="60" align="right">
                                            </br>
                                            </br>
                                            </br>
                                            <p align="right" style="font-size:10px;">'.$row["Gdate"].'</p>
                                        </div>
                                    </div>';

                                }
                            }
                            else{
                                echo "</br>";
                                echo "</br>";
                                echo "</br>";
                                echo "</br>";
                                echo "</br>";
                                echo "<h3> NO CONTENT</h3>";
                                echo "</br>";
                                echo "</br>";
                                echo "</br>";
                                echo "</br>";
                                echo "</br>";
                            }

                        }
                        else{

                            echo "</br>";
                            echo "</br>";
                            echo "</br>";
                            echo "</br>";
                            echo "</br>";
                            echo "<p>You are not a part of any group</p>";
                            echo "<h3> Now you may select or create a Group</h3>";
                            echo "</br>";
                            echo "</br>";
                            echo "</br>";
                            echo "</br>";
                            echo "</br>";
                        }
                    ?>
            </div>
        </div>

        <div id="status" class="cls4"> <!--this belongs to status -->          
            <div  class="container text-center">
                <h1>STATUS</h1>
                <p><em>All Related Info are Given Below.</em></p>
                <h2>#Last Meal Update.</h2>
                <div class="cls5 slideanim">
                    <table class="container-fluid clstbl">
                        <thead>
                            <?php
                                $LastMealDate="";
                                $LastMealAmount="";
                                $tm="mealdate".$userID;
                                $sql="SELECT COUNT(*) as lastID from ".$tm;
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $lastID=$row["lastID"];
                                if($lastID==0){
                                    echo'<tr>
                                        <th><h1>Name</h1></th>
                                        <th><h1>Y/m/d</h1></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                    </tr>';
                                }
                                else{
                                    $sql="SELECT Mdate,Amount from ".$tm." WHERE ID=".$lastID;
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $LastMealDate=$row["Mdate"];
                                    $LastMealAmount=$row["Amount"];
                                    echo'<tr>
                                        <th><h1>Name</h1></th>
                                        <th><h1>'.$row["Mdate"].'</h1></th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    $tm="meal".$userID;
                                    $sql="SELECT * from ".$tm." WHERE ID=".$lastID;
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $arrlength = count($AllMemberID);
                                    for($x = 0; $x < $arrlength; $x++) {
                                        $tm="A".$AllMemberID[$x];
                                        echo '<tr><td>'.$AllMemberName[$x].'</td><td>'.$row[$tm].'</td></tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                </br>
                </br>

                <h2>#Balance Information.</h2>
                <div class="cls5 slideanim">
                    <table class="container-fluid clstbl">
                        <thead>
                            <tr>
                                <th><h1>Name</h1></th>
                                <th><h1>Amount(.tk)</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $arrlength = count($AllMemberID);
                                    for($x = 0; $x < $arrlength; $x++) {
                                        echo '<tr>';
                                            echo '<td>'.$AllMemberName[$x].'</td>';
                                            $tm='bal'.$AllMemberID[$x];
                                            $sql="SELECT SUM(Amount) as total from ".$tm;
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            $sm=(0+$row["total"]);
                                            echo '<td>'.$sm.'</td>';
                                         echo '</tr>';
                                    }
                            ?>
                        </tbody>
                    </table>
                </div>

                </br>
                </br>

                <h2>#Extra Cost Information.</h2>
                <div class="cls5 slideanim">
                    <table class="container-fluid clstbl">
                        <thead>
                            <tr>
                                <th><h1>Date: </h1></th>
                                <th><h1>Amount(.tk)</h1></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php

                            $tm="ext".$userID;
                                $sql="SELECT * from ".$tm." ORDER BY Dat ASC";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()) {
                                        echo '<tr><td>'.$row["Dat"].'</td><td>'.$row["Amount"].'</td></tr>';
                                    }
                                }
                                else{
                                    echo '<tr><td>No Content</td><td>No Content</td></tr>';
                                }

                           ?> 
                        </tbody>
                    </table>
                </div>

            </div>
        </div> <!-- Here end the status-->
        <footer class="text-center">
            <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a><br><br>
            <p><strong>Project: </strong> Online Meal Management.</p>
            <p>Developed By Team: "Zero By Zero", Dept of CSE RU.</p>
        </footer>
    </div><!-- Main Contenet must be inside this div-->
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <!-- This Model For Closing Group -->
      <div class="modal fade modal-fullscreen  " id="ClogGroup"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Close Your Group.</p>
                        </div>
                        <div class="container" style="color:#FB667A;">
                            <div class="mdl_form text-center">
                                <h1 style="color:#FB667A;" >PLEASE READ.</h1>
                                <br>

                            <strong>Are You Sure About This.</strong>
                            <p>This operation means that you are wanting to closing your current meal management group. If You Perform This Operation all information will be lost. Please cheak all the information and let your member awar about this action. If you already conncern about this then continue.</p>
                            </div>
                            <br>
                            <br>
                            <br>

                            <div class="col-sm-12">
                                <div class="col-sm-12 text-center">
                                    <button id="CloseGroup" type="button" class="btn btn-danger">Close Your Group. <span class="glyphicon glyphicon-ok-sign"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Model For Adding Notice -->
        <div class="modal fade modal-fullscreen  " id="AddNotice"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Add Notice</p>
                        </div>
                        <div class="container">
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="ANtdate" style="color:#FB667A;">Till:</label>
                                  <input type="date" class="form-control" id="ANtdate" maxlength=20>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="ANtmsg" style="color:#FB667A;">Notice:</label>
                                  <textarea class="form-control" style="resize:none;" rows="10" id="ANtmsg" maxlength="1490" placeholder="Type:"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button id="ANTbtn" type="button" class="btn btn-primary">OK <span class="glyphicon glyphicon-ok"></span></button>
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- This Model For Common Meal Update-->
        <div class="modal fade modal-fullscreen  " id="Common_Meal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Common Meal.</p>
                        </div>
                        <div class="container">
                            <h2  style="color:#FB667A;">#Members Recommended Meal.</h2>
                            <table class="container-fluid clstbl">
                                <thead>
                                    <tr>
                                        <th><h1>Name</h1></th>
                                        <th><h1>Meal Req</h1></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $arrlength = count($AllMemberID);
                                    for($x = 0; $x < $arrlength; $x++) {
                                        echo "<tr><td>".$AllMemberName[$x]."</td><td>".$AllMemberMeal[$x]."</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row mdl_edit text-center">
                                  <h3 style="color:#FB667A;">Fill Information.</h3>
                                  <div class="col-sm-6 form-group" style="text-align: left; color:#FB667A;">
                                    <div class="form-group">
                                      <label for="lastcmdate">Last Date:</label>
                                      <input type="text" class="form-control" id="lastcmdate" readonly value="<?php echo $LastMealDate; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-6 form-group" style="text-align: left; color:#FB667A;">
                                    <div class="form-group">
                                      <label for="Lastcmcost">Last Meal Rate:</label>
                                      <input type="text" class="form-control" id="Lastcmcost" readonly value="<?php echo $LastMealAmount; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-6 form-group" style="text-align: left; color:#FB667A;">
                                    <div class="form-group">
                                      <label for="cmdate">Choose Date:</label>
                                      <input type="date" class="form-control" id="cmdate">
                                    </div>
                                  </div>
                                  <div class="col-sm-6 form-group" style="text-align: left; color:#FB667A;">
                                    <div class="form-group">
                                      <label for="cmcost">Meal Rate:</label>
                                      <input type="text" class="form-control" id="cmcost" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="3">
                                    </div>
                                  </div>
                                  <div class="col-sm-12 form-group">
                                      <button id="cmConfirm" type="button" class="btn btn-primary">Confirm <span class="glyphicon glyphicon-ok-sign"></span></button>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- This Model For Meal Update-->
        <div class="modal fade modal-fullscreen  " id="Meal_Update"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Update Meal</p>
                        </div>
                        <div class="container">
                            <div class="form-group">
                                 <label for="MMeID" style="color:#FB667A;">Choose A Member:</label>
                                <select id="MMeID" class="form-control clsinpt">
                                        <option value="" disabled selected hidden>Select A Member.</option>
                                        <?php
                                            $arrlength = count($AllMemberID);
                                            for($x = 0; $x < $arrlength; $x++) {
                                                echo '<option style="color: black" value="'.$AllMemberID[$x].'">'.$AllMemberName[$x].'</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div id="MuContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Model For Balance Update-->
        <div class="modal fade modal-fullscreen  " id="Balance_Update"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter; color: #3fb0ac" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid ">
                        <div class="up_head">
                            <p>Update Balance</p>
                        </div>
                        <div class="container">
                            <div class="form-group">
                                 <label for="BMeID" style="color:#FB667A;">Choose A Member:</label>
                                <select id="BMeID" class="form-control clsinpt">
                                        <option value="" disabled selected hidden>Select A Member.</option>
                                        <?php
                                            $arrlength = count($AllMemberID);
                                            for($x = 0; $x < $arrlength; $x++) {
                                                echo '<option style="color: black" value="'.$AllMemberID[$x].'">'.$AllMemberName[$x].'</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div id="BuContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Model For Extra cost Update-->
        <div class="modal fade modal-fullscreen  " id="Extra_Cost_Update"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Update ExtraCost</p>
                        </div>
                        <div class="container" id="ExContent">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Model For Member Request-->
        <div class="modal fade modal-fullscreen  " id="mem_req"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>All Member Request.</p>
                        </div>
                        <div class="container">
                            <div id="JoinContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- This Model For ProPic Update-->
        <div class="modal fade modal-fullscreen  " id="UpdateProfile"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Update Pfrofile</p>
                        </div>
                        <div class="container" >
                     
                        <form action="changeProPic.php" method="post" class="mdl_form" enctype="multipart/form-data">
                             <div class="form-group">
                                <h3 style="color:#FB667A;">Update Your Profile Picture</h3>
                                <input type="file" name="fileToUpload" id="fileToUpload" class="file" accept="image/jpg, image/jpeg, image/png">
                                <div class="input-group col-xs-12">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                  <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
                                  <span class="input-group-btn">
                                    <button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
                                  </span>
                                </div>
                              </div>
                              <button class="btn btn-primary btn-sm" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Confirm</button>
                          </form>

                        </div>
                        <div class="container">
                        </div>
                        <div class="container">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade modal-fullscreen  " id="MealStatus"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                     </div>
                     <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>My Meal</p>
                        </div>
                        <div class="container">
                            <table class="container-fluid clstbl">
                            <thead>
                                <tr>
                                    <th><h1>Date</h1></th>
                                    <th><h1>Meal Rate</h1></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $tm="mealdate".$userID;
                                    $sql="SELECT Mdate , Amount FROM ".$tm;
                                    $result = $conn->query($sql);
                                    if($result->num_rows > 0){
                                        while($row = $result->fetch_assoc()) {
                                            echo '
                                            <tr>
                                                <td>'.$row["Mdate"].'</td>
                                                <td>'.$row["Amount"].'</td>
                                            </tr>';
                                        }
                                    }
                                    else{
                                        echo '
                                            <tr>
                                                <td>No Content</td>
                                                <td>No Content</td>
                                            </tr>';
                                    }
                                    if($userID!=""){
                                        $tm="member".$userID;

                                        $sql="SELECT Meal FROM ".$tm." WHERE ID=".$userID;
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_array();
                                        $curMeal=$row['Meal'];
                                    }
                                ?>
                            </tbody>
                        </table>
                            
                            <div class="row mdl_edit text-center">
                                <h3 style="color:#FB667A;">EDIT INFO.</h3>
                                <p style="color:#FB667A;"><strong>Notice: </strong> Dear member Your changes
                                are applicable for the dates which is not in table.</p>
                                <div class="col-sm-12 form-group">
                                    <label for="MLamount" style="color:#FB667A;">Your Running Meal:</label>
                                    <input class="form-control" type="text" id="MLamount" maxlength="4" readonly value="<?php echo $curMeal;?>">
                                </div>
                                <div class="col-sm-12 form-group">
                                    <div class="col-sm-12 form-group">
                                        <button id="Half" type="button" class="btn btn-info pull-left">Add Half <span class="glyphicon glyphicon-ok-sign"></span></button>
                                        <button id="Zero" type="button" class="btn btn-info">Set Zero <span class="glyphicon glyphicon-ok-sign"></span></button>
                                        <button id="Full" type="button" class="btn btn-info pull-right">Add Full <span class="glyphicon glyphicon-ok-sign"></span></button>
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group">
                                <button id="CHbtn" type="button" class="btn btn-primary">Save <span class="glyphicon glyphicon-ok"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 <!-- Animate Page slide -->
      <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
              if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                  scrollTop: $(hash).offset().top
                }, 900, function(){
                  window.location.hash = hash;
                });
              }
            });
            $(window).scroll(function() {
                $(".slideanim").each(function(){
                  var pos = $(this).offset().top;

                  var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                      $(this).addClass("slide");
                    }
                });
            });
          })
    </script>

  </body>
</html>
<?php
    $conn->close();
?>
