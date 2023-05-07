<?php
include "dbconn.php";

$sql = "update schedule set ScheduleName = ?,ScheduleStart = ?, ScheduleEnd= ? where ScheduleID = ?";
//LocationID,LocationName,City, State, Country
//`ScheduleID`, `ScheduleName`, `ScheduleStart`, `ScheduleEnd`
$schID = $_REQUEST["schID"];
$schName = $_REQUEST["schName"];
$schStart = $_REQUEST["schStart"];
$schEnd = $_REQUEST["schEnd"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $schName, $schStart, $schEnd, $schID);
//$stmt->execute(); 

//printf("%d rows updated.\n", $stmt->affected_rows);

if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'schedule.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>