<?php
   include("dbconn.php");
   session_start();
   $error ='';
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       echo "<script type='text/javascript'>alert('Inside Post!')</script>";
      // username and password sent from form 
      
      //$myusername = mysqli_real_escape_string($db,$_POST['username']);
      //$mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      $username = $_POST["username"];
	  $password = $_POST["password"];
      $hash = password_hash($password,PASSWORD_DEFAULT);
      echo $username;
      echo $hash;
      
      $sql = "SELECT PasswordHash FROM user WHERE UserID = '$username'";
      $result = mysqli_query($conn, $sql);
      echo "<script type='text/javascript'>alert('After SQL query execution...!')</script>";
      if ($result->num_rows >0) {
            echo "<script type='text/javascript'>alert('Inside If Block...!')</script>";
            $row = $result->fetch_assoc();
            
            if(password_verify($password, $row["PasswordHash"]) == true) {    
                echo "<script type='text/javascript'>alert('Login is successfull!')</script>";
                $_SESSION['UserID']=$_POST['username'];
                header("location: course_schedule_availability_report.php");
            }else {
                echo "<script type='text/javascript'>alert('Your Login Name or Password is invalid!   Try again.')</script>";
                $error = "Your Login Name or Password is invalid.  Try again.";
            }
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
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
      <h3>U.S. Tech Summer Camp Portal - Login</h3>
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">

            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit " onclick="alert();"/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>