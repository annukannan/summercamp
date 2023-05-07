<?php
include "dbconn.php";
$id = $_REQUEST["locID"];
$sql_select = "SELECT * from course where LocationId=?";
					
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
	echo '<script>alert("Location is tied to a Course")</script>';
	echo "<script>window.location.href = 'course_location.php'</script>";
} else {
	$sql = "delete from course_location where LocationID=?";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $id);
	if($stmt->execute() === TRUE) {
		echo "<script>window.location.href = 'course_location.php'</script>";
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
$conn->close();
?>