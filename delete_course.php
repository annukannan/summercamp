<?php
include "dbconn.php";
$id = $_REQUEST["courseID"];
$sql_select = "SELECT * from course_schedule where CourseID=?";
					
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
	echo '<script>alert("Course is tied to a Schedule.  Cannot Delete")</script>';
	echo "<script>window.location.href = 'course.php'</script>";
} else {
	$sql = "delete from course where CourseID=?";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $id);
	if($stmt->execute() === TRUE) {
		echo "<script>window.location.href = 'course.php'</script>";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
$conn->close();
?>