<?php
	include "dbconn.php";

	// The following code checks if the submit button is clicked
	// and inserts the data in the database accordingly
	if(isset($_POST['submit']))
	{
		
		$schid = mysqli_real_escape_string($conn,$_POST['schID']);
		$schname = mysqli_real_escape_string($conn,$_POST['schName']);
		$schstart = mysqli_real_escape_string($conn,$_POST['schStart']);
		$schend = mysqli_real_escape_string($conn,$_POST['schEnd']);
		
		// Creating an insert query using SQL syntax and
		// storing it in a variable.
		$sql_insert =
		"INSERT INTO `schedule`(`ScheduleID`, `ScheduleName`, `ScheduleStart`, `ScheduleEnd`)
			VALUES ('$schid','$schname', '$schstart', '$schend')";
		
		// The following code attempts to execute the SQL query
		// if the query executes with no errors
		// a javascript alert message is displayed
		// which says the data is inserted successfully
		if(mysqli_query($conn,$sql_insert))
		{
			echo '<script>alert("Schedule added successfully")</script>';
			echo "<script>window.location.href = 'schedule.php'</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
</head>
<body>

<form method="POST">
    <label for "ScheduleID">Schedule ID:</label><br>
    <input type="text" id="schID" name="schID"><br>
    <label for "ScheduleName">Schedule Name:</label><br>
    <input type="text" id="schName" name="schName"><br>
    <label for "ScheduleStart">Schedule Start:</label><br>
    <input type="text" id="schStart" name="schStart"><br>
    <label for "ScheduleEnd">Schedule End:</label><br>
    <input type="text" id="schEnd" name="schEnd"><br>

	<input type="submit" value="submit" name="submit">
</form>
	<br>
</body>
</html>
