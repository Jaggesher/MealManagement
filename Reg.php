<!DOCTYPE html>
<html>
	<head>
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="mycss/Reg.css"/>
		<script src="myjs/reg.js"></script>
	</head>

	<body class="cls0">
		<div class="cls1">
			<div class="Empty"></div>
			<div class="RegBlock">
				<center class="Reg">Please Register.</center>
				<form action="RegTm.php" method="post" name="reg_input" onsubmit="return Chk_Valid()">
					<input  type="email" name="userEmail" value="" placeholder="Email.." id="email" onclick="Reform_email()">
					</input>
					<input type="text" name="userName" value="" placeholder="Full Name.." id="name" maxlength="30" onclick="Refrom_name()" >
					</input>

					<input  type="password" name="userPassword" value="" placeholder="Password.." id="password" maxlength="30" onclick="Reform_pass()">
					</input>

					<input  type="password" name="confirmPassword" value="" placeholder="Confirm Password.." id="cpassword" maxlength="30" onclick="Reform_cpass()">
					</input>

					<input type="date" name="birthdate" id="bdate" onclick="Reform_date()">
					</input>

					<select name="Gender" ID="gender" onclick="Reform_gender()">
						<option value="" disabled selected hidden>Select Your Gender.</option>
						<option style="color: black" value="Male">Male</option>
						<option style="color: black" value="Female">Female</option>
						<option style="color: black" value="Other">Other</option>
					</select>

					<input  type="text" name="usermobile" value="" placeholder="Mobile.." id="mobile"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="11" onclick="Reform_mobile()">
					</input>

					<button type="submit" id="continue">Continue.</button>
				</form>
			</div>
			</br>
			</br>
			</br>
			</br>
			</br>
			</br>
			</br>
			</br>
			</br>
			</br>

			<div class="cls4">
				<br/>
				<center>All Right Preserved.</center>
		    </div>

		</div>
	</body>
</html>