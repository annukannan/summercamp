<?php
	include "dbconn.php";
	
	// Get all the categories from category table
	$sql = "SELECT * FROM `course_category`";
	$all_categories = mysqli_query($conn,$sql);
	$sql1 = "SELECT * FROM `course_location`";
	$all_locations = mysqli_query($conn,$sql1);

	// The following code checks if the submit button is clicked
	// and inserts the data in the database accordingly
	if(isset($_POST['submit']))
	{
		// Store the Course Id/name in a "name" variable
		$cid = mysqli_real_escape_string($conn,$_POST['CourseID']);
		$cname = mysqli_real_escape_string($conn,$_POST['CourseName']);
		
		// Store the Category ID in a "id" variable
		$catid = mysqli_real_escape_string($conn,$_POST['CategoryID']);
		$locid = mysqli_real_escape_string($conn,$_POST['LocationID']);
		
		// Creating an insert query using SQL syntax and
		// storing it in a variable.
		$sql_insert =
		"INSERT INTO `course`(`CourseID`, `CourseName`,`LocationID`, `CategoryID`)
			VALUES ('$cid','$cname', '$locid', '$catid')";
		
		// The following code attempts to execute the SQL query
		// if the query executes with no errors
		// a javascript alert message is displayed
		// which says the data is inserted successfully
		if(mysqli_query($conn,$sql_insert))
		{
			echo '<script>alert("Course added successfully")</script>';
			echo "<script>window.location.href = 'course.php'</script>";
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
		<label>Course ID:</label>
		<input type="text" name="CourseID" required><br>
		<label>Course Name:</label>
		<input type="text" name="CourseName" required><br>
		<label>Select a Category</label>
		<select name="CategoryID">
			<?php
				// use a while loop to fetch data
				// from the $all_categories variable
				// and individually display as an option
				while ($category = mysqli_fetch_array(
						$all_categories,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $category["CategoryID"];
					// The value we usually set is the primary key
				?>">
					<?php echo $category["CategoryType"];
						// To show the category name to the user
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
				// use a while loop to fetch data
				// from the $all_locations variable
				// and individually display as an option
				while ($location = mysqli_fetch_array(
						$all_locations,MYSQLI_ASSOC)):;
			?>
				<option value="<?php echo $location["LocationID"];
					// The value we usually set is the primary key
				?>">
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
	<br>
</body>
</html>
