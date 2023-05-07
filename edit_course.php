<?php
include "dbconn.php";

	// Get all the categories from category table
	$sql0 = "SELECT * FROM `course_category`";
	$all_categories = mysqli_query($conn,$sql0);
	$sql1 = "SELECT * FROM `course_location`";
	$all_locations = mysqli_query($conn,$sql1);

$sql = "SELECT * FROM course where CourseID = ?";
$id = $_REQUEST["courseID"];
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
		$cname = mysqli_real_escape_string($conn,$_POST['CourseName']);
		$catid = mysqli_real_escape_string($conn,$_POST['CategoryID']);
		$locid = mysqli_real_escape_string($conn,$_POST['LocationID']);
		
		$sql_update = "update course set CourseName=?, LocationID=?, CategoryID=? where CourseID=?";
		$stmt = $conn->prepare($sql_update);
		$stmt->bind_param("siii",$_REQUEST["CourseName"],$_REQUEST["LocationID"],$_REQUEST["CategoryID"],$_REQUEST["CourseID"]);
		
		if($stmt->execute() === TRUE)
		{
			echo '<script>alert("Course updated successfully")</script>';
			echo "<script>window.location.href = 'course.php'</script>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>
<form method="POST">
		<input type="hidden" name="CourseID" value="<?php echo $row["CourseID"];?>"> 
		<label>Course Name:</label>
		<input type="text" name="CourseName" value="<?php echo $row["CourseName"];?>" required><br>
		<label>Select a Category</label>
		<select name="CategoryID">
			<?php
				while ($category = mysqli_fetch_array($all_categories,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $category["CategoryID"];?>" <?php if($row["CategoryID"] == $category["CategoryID"]) echo 'selected="selected"'; ?> >
					<?php echo $category["CategoryType"];
					?>
				</option>
			<?php
				endwhile;
				// While loop must be terminated
			?>
		</select>
		<br>
		<label>Select a Location</label>
		<select name="LocationID">
			<?php
				while ($location = mysqli_fetch_array($all_locations,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $location["LocationID"]; ?>" <?php if($row["LocationID"] == $location["LocationID"]) echo 'selected="selected"'; ?>  >
					<?php echo $location["LocationName"];?>-
					<?php echo $location["City"];?>-
					<?php echo $location["State"];?>-
					<?php echo $location["Country"];?>
				</option>
			<?php
				endwhile;
				// While loop must be terminated
			?>
		</select>
		<br>
		<input type="submit" value="submit" name="submit">
</form>