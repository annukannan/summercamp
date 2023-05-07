<?php
	include "dbconn.php";
	
	// Get all the courses and schedules from course table and schedule table
	$sql = "SELECT * FROM `course`";
	$all_courses = mysqli_query($conn,$sql);
	$sql1 = "SELECT * FROM `schedule`";
	$all_schedules = mysqli_query($conn,$sql1);

	// The following code checks if the submit button is clicked
	// and inserts the data in the database accordingly
	if(isset($_POST['submit']))
	{
		// Store the Course Id/name in a "name" variable
		$cid = mysqli_real_escape_string($conn,$_POST['CourseID']);
		$schid = mysqli_real_escape_string($conn,$_POST['ScheduleID']);
		$cschid = mysqli_real_escape_string($conn,$_POST['CourseScheduleID']);
		$availability = mysqli_real_escape_string($conn,$_POST['Availability']);
		
		// Creating an insert query using SQL syntax and
		// storing it in a variable.
		$sql_insert =
		"INSERT INTO `course_schedule`(`Availability`, `Course_Schedule_ID`, `CourseID`, `ScheduleID`)
			VALUES ('$availability','$cschid', '$cid', '$schid')";
		
		// The following code attempts to execute the SQL query
		// if the query executes with no errors
		// a javascript alert message is displayed
		// which says the data is inserted successfully
		if(mysqli_query($conn,$sql_insert))
		{
			echo '<script>alert("Course Schedule added successfully")</script>';
			echo "<script>window.location.href = 'course_schedule.php'</script>";
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
		<label>Course Schedule ID:</label>
		<input type="text" name="CourseScheduleID" required><br>

		<label>Select a Course</label>
		<select name="CourseID">
			<?php
				// use a while loop to fetch data
				// from the $all_courses variable
				// and individually display as an option
				while ($course = mysqli_fetch_array(
						$all_courses,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $course["CourseID"];
					// The value we usually set is the primary key
				?>">
					<?php echo $course["CourseName"];
						// To show the course name to the user
					?>
				</option>
			<?php
				endwhile;
				// While loop must be terminated
			?>
		</select>
		<br>
		<label>Select a Schedule</label>
		<select name="ScheduleID">
			<?php
				// use a while loop to fetch data
				// from the $all_schedules variable
				// and individually display as an option
				while ($schedule = mysqli_fetch_array(
						$all_schedules,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $schedule["ScheduleID"];
					// The value we usually set is the primary key
				?>">
					<?php echo $schedule["ScheduleName"];?>
				</option>
			<?php
				endwhile;
				// While loop must be terminated
			?>
		</select>
		<br>
		<label>Availability:</label>
		<input type="text" name="Availability" required><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<br>
</body>
</html>
