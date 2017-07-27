<?php

    session_start();

    if(!isset($_SESSION["ID"]) || $_SESSION["ID"]==""){
        header('location:index.php');
    }
    else if(isset($_SESSION["STUS"]) && $_SESSION["STUS"]=="manager"){
        header('location:manager.php');
    }
    if($_SESSION["STUS"]=="none") {$_SESSION["MG"]="";}
    $userID=$_SESSION["MG"];
    $memID=$_SESSION["ID"];
    include 'dbconnect.php';
    $AllMoney=0;
    $AllMEal=0;
    $AllMealCost=0;
    $FixedCost=0;
    $total=0;
    $Due=0;
    $Extra=0;
    $MEAL=array();
    $MEALDAT=array();

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
      <link rel="stylesheet" type="text/css" href="mycss/member.css"/>
      <script src="myjs/member.js"></script>
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
            <li><a href="#account">ACCOUNT</a></li>
            <!-- <li><a href="#" data-toggle="modal" data-target="#FindManager"><span class="glyphicon glyphicon-search"></span></a></li> -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" data-toggle="modal" data-target="#FindManager">Serch Group</a></li>
                <li><a href="#" data-toggle="modal" data-target="#MealStatus">My Meal</a></li>
                <li><a href="#" data-toggle="modal" data-target="#CreateGroup">Create Group</a></li>
                <li><a href="#" data-toggle="modal" data-target="#UpdateProfile">Edit Profile</a></li>
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
                            $FixedCost+=$result2['Fix'];
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
            </div>
            
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
            
            <div id="account" class="cls4" ><!-- Account Div-->
                 <div  class="container text-center"> 
                    <h1>ACCOUNT</h1>
                    <p><em>All Available Information Are Below.</em></p>
                    <h2>#Meal Information.</h2>
                    <div class="cls5 slideanim">
                        <table class="container-fluid clstbl">
                            <thead>
                                <tr>
                                    <th><h1>Date</h1></th>
                                    <th><h1>Meal</h1></th>
                                    <th><h1>Meal Rate</h1></th>
                                    <th><h1>Cost</h1></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($userID!="")
                            {
                                $tm1="meal".$userID;
                                $tm2="mealdate".$userID;
                                $tm3="A".$memID;
                                $sql="SELECT ".$tm2.".Amount AS Amount,".$tm2.".Mdate AS Dat, ".$tm1.".".$tm3." from ".$tm1." INNER JOIN ".$tm2." ON ".$tm2.".ID=".$tm1.".ID";
                                $result = $conn->query($sql);
                                echo $conn->error;
                                if($result->num_rows > 0){
                                  while($row = $result->fetch_assoc()) {
                                    $MEALDAT[]=$row["Dat"];
                                    $MEAL[]=$row["Amount"];
                                    $tm=$row["Amount"]*$row["$tm3"];
                                    $AllMEal+=$row[$tm3];
                                    $AllMealCost+=$tm;
                                    echo ' <tr>
                                        <td>'.$row["Dat"].'</td>
                                        <td>'.$row[$tm3].'</td>
                                        <td>'.$row["Amount"].'</td>
                                        <td>'.$tm.'</td>
                                    </tr>';
                                  }  
                                }
                                else{
                                   echo' <tr>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                    </tr>';
                                }
                            }
                            else{
                                echo' <tr>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                    </tr>';
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
                                    <th><h1>Date</h1></th>
                                    <th><h1>Amount(.tk)</h1></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($userID!=""){
                                        $tm="bal".$memID;
                                        $sql="SELECT * FROM ".$tm;
                                        $result = $conn->query($sql);
                                        if($result->num_rows > 0){
                                          while($row = $result->fetch_assoc()){
                                            $AllMoney+=$row["Amount"];
                                            echo' <tr>
                                            <td>'.$row["Dat"].'</td>
                                            <td>'.$row["Amount"].'</td>
                                            </tr>';
                                          }
                                        }
                                        else{
                                            echo' <tr>
                                            <td>No Content</td>
                                            <td>No Content</td>
                                            </tr>';
                                          }
                                    }
                                    else{
                                        echo' <tr>
                                        <td>No Content</td>
                                        <td>No Content</td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </br>
                    </br>

                    <h2>#Account Summary.</h2>
                    <div class="cls5 slideanim">
                        <table class="container-fluid clstbl">
                            <tbody>
                                <?php
                                $ExtraCost=0;
                                if($userID!=""){
                                    $tm="member".$userID;
                                    $sql="SELECT COUNT(*) as total FROM ".$tm." WHERE Type!='join'";
                                    $result = $conn->query($sql);
                                    $row_array=$result->fetch_array();
                                    $member=$row_array['total'];
                                    if($member==0) $member=1;

                                     $tm="ext".$userID;
                                     $sql="SELECT SUM(Amount) as total from ".$tm;
                                     $result = $conn->query($sql);
                                     $row_array=$result->fetch_array();
                                     $ExtraCost=($row_array['total']/$member);
                                     $ExtraCost=round($ExtraCost,2);
                                     $total=$AllMealCost+$FixedCost+$ExtraCost;
                                     $Due=0;
                                     $Extra=0;
                                     if($total>$AllMoney){
                                        $Due=$total-$AllMoney;
                                     }
                                     else{
                                        $Extra=$AllMoney-$total;
                                     }
                                 }
                                    
                                ?>
                                <tr>
                                    <td>Total Meal</td>
                                    <td><?php echo $AllMEal;?></td>
                                </tr>
                                <tr>
                                    <td>Total Meal Cost</td>
                                    <td><?php echo $AllMealCost;?></td>
                                </tr>
                                <tr>
                                    <td>Fixed Cost</td>
                                    <td><?php echo $FixedCost;?></td>
                                </tr>
                                <tr>
                                    <td>Extra Cost</td>
                                    <td><?php echo $ExtraCost;?></td>
                                </tr>
                                <tr>
                                    <td>Total Spent</td>
                                    <td> <?php echo $total;?> </td>
                                </tr>
                                <tr>
                                    <td>Your Money</td>
                                    <td><?php echo $AllMoney;?></td>
                                </tr>
                                <tr>
                                    <td>Due</td>
                                    <td><?php echo $Due;?></td>
                                </tr>
                                <tr>
                                    <td>Extra</td>
                                    <td><?php echo $Extra;?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            
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

    <!-- This Model For Serch button -->
      <div class="modal fade modal-fullscreen  " id="FindManager"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                     </div>
                     <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Find Group</p>
                        </div>
                        <div class="container">
                            <div class="form-group col-sm-12">
                                <label for="FindGrpID" style="color:#FB667A;">Choose A Group:</label>
                                <select id="FindGrpID" class="form-control clsinpt">
                                        <option value="" disabled selected hidden>Select A Group.</option>
                                        <?php
                                            $sql="SELECT ID, Name From manager";
                                            $result = $conn->query($sql);
                                            if($result->num_rows > 0){
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option style="color: black" value="'.$row["ID"].'">'.$row["Name"].'</option>';
                                                }
                                            }
                                            else{
                                                echo '<option style="color: black" value="">No Content</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="container-fluid" id="FindGroupCont">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- This Model For Creating Group -->
        <div class="modal fade modal-fullscreen  " id="CreateGroup"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="font-size: 50px;font-weight: lighter;" data-dismiss="modal" aria-hidden="true">X</button>
                    </div>
                    <div class="modal-body container-fluid">
                        <div class="up_head">
                            <p>Create Group</p>
                        </div>
                        <div class="container">
                            <div class="col-sm-8">
                                <div class="form-group">
                                  <label for="Gname" style="color:#FB667A;">Group Name:</label>
                                  <input type="text" class="form-control" id="Gname" placeholder="Group Name..." maxlength=20>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="fxamount" style="color:#FB667A;">Fixed Cost:</label>
                                  <input type="text" class="form-control" id="fxamount" placeholder="Amount.." onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="4">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="Gabout" style="color:#FB667A;">About:</label>
                                  <textarea class="form-control" style="resize:none;" rows="10" id="Gabout" maxlength="1000" placeholder="About.."></textarea>
                                </div>
                            </div>
                            <?php
                             if($userID==""){
                                echo '
                                <div class="col-sm-12">
                                    <button id="CGbtn" type="button" class="btn btn-primary">OK <span class="glyphicon glyphicon-ok"></span></button>
                                </div>';
                             }
                             else{
                                echo '<p style="color:#FB667A;">We are sorry that you are not capable of performing this action.</p>';
                             }
                            ?>
                             
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
                                    $curMeal=0;
                                    $arrlength = count($MEAL);
                                    if($arrlength>0){
                                        for($x = 0; $x < $arrlength; $x++) {
                                            echo '
                                            <tr>
                                                <td>'.$MEALDAT[$x].'</td>
                                                <td>'.$MEAL[$x].'</td>
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

                                        $sql="SELECT Meal FROM ".$tm." WHERE ID=".$memID;
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
                                <?php
                                 if($userID!=""){
                                    echo '
                                    <div class="col-sm-12 form-group">
                                    <button id="CHbtn" type="button" class="btn btn-primary">Save <span class="glyphicon glyphicon-ok"></span></button>
                                    </div> ';
                                 }
                                 else{
                                    echo '<p style="color:#FB667A;">We are sorry that you are not capable of performing this action.</p>';
                                 }
                                ?>
                            </div>
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
          });
      </script>
  </body>
</html>

<?php
    $conn->close();
?>
