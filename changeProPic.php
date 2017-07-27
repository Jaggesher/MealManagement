<?php
	session_start();
    if(isset($_SESSION['ID']) && !empty($_SESSION['ID'])){

		$target_dir = "images/";
		$userID=$_SESSION["ID"];

		$target_file = basename($_FILES["fileToUpload"]["name"]);


		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$target_file=$userID.".".$imageFileType;
		$target_file=$target_dir.$target_file;
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}

		if ($_FILES["fileToUpload"]["error"]==1) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}

		if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
		    echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
		    $uploadOk = 0;
		}

		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		}else if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
			include 'dbconnect.php';
			$sql="UPDATE account SET Pro='".$target_file."' WHERE ID=".$userID;
			if($conn->query($sql)===TRUE){
		  		header('location:member.php');
		  	}
		  	else{
		  		echo "Error UpD: ".$conn->error;
		  	}
			$conn->close();

			}

	}else{
		echo "You Are Not Logged In";
	}
?>