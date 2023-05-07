<?php
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Courses | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Course Schedule</h3>";

	// Get all the courses and schedules from course table and schedule table
	$sql = "SELECT * FROM `course`";
	$all_courses = mysqli_query($conn,$sql);
	$sql1 = "SELECT * FROM `schedule`";
	$all_schedules = mysqli_query($conn,$sql1);

$sql = "SELECT * FROM course_schedule where Course_Schedule_ID = ?";
$id = $_REQUEST["courseScheduleID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}

	// The following code checks if the submit button is clicked
	// and inserts the data in the database accordingly
	if(isset($_POST['submit']))
	{
		// Store the Course Id/name in a "name" variable
		$cid = mysqli_real_escape_string($conn,$_POST['CourseID']);
		$schid = mysqli_real_escape_string($conn,$_POST['ScheduleID']);
		$cschid = mysqli_real_escape_string($conn,$_POST['CourseScheduleID']);
		$availability = mysqli_real_escape_string($conn,$_POST['Availability']);
		
		$sql_update = "update course_schedule set availability=?, scheduleid=?, courseid=? where Course_Schedule_ID=?";
		$stmt = $conn->prepare($sql_update);
		$stmt->bind_param("iiii",$_REQUEST["Availability"],$_REQUEST["ScheduleID"],$_REQUEST["CourseID"],$_REQUEST["CourseScheduleID"]);
		
		if($stmt->execute() === TRUE)
		{
			echo '<script>alert("Course Schedule updated successfully")</script>';
			echo "<script>window.location.href = 'course_schedule.php'</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>
<form method="POST">
		<input type="hidden" name="CourseScheduleID" value="<?php echo $row["Course_Schedule_ID"];?>"> 

		<label>Select a Course</label>
		<select name="CourseID">
			<?php
				while ($course = mysqli_fetch_array($all_courses,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $course["CourseID"]; ?>" <?php if($row["CourseID"] == $course["CourseID"]) echo 'selected="selected"'; ?> >
					<?php echo $course["CourseName"];?>
				</option>
			<?php
				endwhile;
			?>
		</select>
		<br>
		<label>Select a Schedule</label>
		<select name="ScheduleID">
			<?php
				while ($schedule = mysqli_fetch_array($all_schedules,MYSQLI_ASSOC)):;
				echo '<script>alert("Schedule Id from List = <?php echo $schedule["ScheduleID"];?>")</script>';
				echo '<script>alert("Schedule Id from Row/Record = <?php echo $row["ScheduleID"];?>")</script>';
			?>
				
				<option value="<?php echo $schedule["ScheduleID"];?>" <?php if($schedule["ScheduleID"]==$row["ScheduleID"]) echo 'selected="selected"'; ?> >
					<?php echo $schedule["ScheduleName"];?>
				</option>
			<?php
				endwhile;
				// While loop must be terminated
			?>
		</select>
		<br>
		<label>Availability:</label>
		<input type="text" name="Availability" value="<?php echo $row["Availability"]; ?>" required><br>
		<input type="submit" value="submit" name="submit">
	</form>
	<br>
	</body>
</html>