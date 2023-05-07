<?php
	
$showAlert = false;
$showError = false;
$exists=false;
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Include file which makes the
	// Database Connection.
	include "dbconn.php";

	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];
	
	$sql = "Select * from user where UserID='$username'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
	
	// This sql query is use to check if
	// the username is already present
	// or not in our Database
	if($num == 0) {
		if(($password == $cpassword) && $exists==false) {
	
			$hash = password_hash($password,
								PASSWORD_DEFAULT);
				
			// Password Hashing is used here.
			$sql = "INSERT INTO `user` ( `UserID`,
				`PasswordHash`,`FirstName`, `LastName`, `EmailID`) VALUES ('$username',
				'$hash', '$firstname','$lastname','$email')";
	
			$result = mysqli_query($conn, $sql);
	
			if ($result) {
				$showAlert = true;
			}
		}
		else {
			$showError = "Passwords do not match";
		}	
	}// end if
	
if($num>0)
{
	$exists="Username not available";
}
	
}//end if
	
?>
	
<!doctype html>
	
<html lang="en">

<head>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1,
		shrink-to-fit=no">
	
</head>
	
<body bgcolor = "#FFFFFF">
	
<?php
	
	if($showAlert) {
	
		echo ' <div class="alert alert-success
			alert-dismissible fade show" role="alert">
	
			<strong>Success!</strong> Your account is
			now created and you can login.
			<a href="user_login.php">Login</a>
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
	}
	
	if($showError) {
	
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close">
			<span aria-hidden="true">×</span>
	</button>
	</div> ';
}
		
	if($exists) {
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div> ';
	}

?>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
	  <h3 text-align="center">U.S. Tech Summer Camp Portal - Registration </h3>
      <div align = "center">
         <div style = "width:600px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Signup Here</b></div>
				
            <div style = "margin:30px">
	
	<form action="user_registration.php" method="post">
	
		<label for="username">Username</label>
		<input type="text" class = "box" id="username" name="username" aria-describedby="emailHelp">	
		<br /><br />
		<label for="password">Password</label>
		<input type="password" class = "box" id="password" name="password">
		<br /><br />
		<label for="cpassword">Confirm Password</label>
		<input type="password" class = "box" id="cpassword" name="cpassword">
	
			<small id="emailHelp" class="form-text text-muted">
			Make sure to type the same password
			</small>

		<br /><br />

			<label for="firstname">First Name</label>
			<input type="firstname" class = "box"
			id="firstname" name="firstname">

		<br /><br />

			<label for="lastname">Last Name</label>
			<input type="lastname" class = "box"
			id="lastname" name="lastname">

		<br /><br />

			<label for="email">Email</label>
			<input type="email" class = "box"
			id="email" name="email">

		<br /><br />

		<input type = "submit" value = " SignUp " onclick="alert();"/><br />

	</form>
	</div>
		</div>
</div>
	
</body>
</html>
