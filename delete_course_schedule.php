<?php
include "dbconn.php";
$sql = "delete from course_schedule where Course_Schedule_ID=?";
$id = $_REQUEST["courseScheduleID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'course_schedule.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>