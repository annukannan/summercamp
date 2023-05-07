<?php
include "dbconn.php";
$sql = "delete from schedule where ScheduleID=?";
$id = $_REQUEST["schID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'schedule.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>