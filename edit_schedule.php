<?php
include "dbconn.php";

$sql = "SELECT * FROM schedule where ScheduleID = ?";
$id = $_REQUEST["schID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}

?>
<form action="update_schedule.php">
		<input type="hidden" name="schID" value="<?php echo $row["ScheduleID"]?>"><br>
		<label>Schedule Name:</label>
		<input type="text" name="schName" value="<?php echo $row["ScheduleName"]?>" required><br>
		<label>Schedule Start:</label>
		<input type="text" name="schStart" value="<?php echo $row["ScheduleStart"]?>" required><br>
		<label>Schedule End:</label>
		<input type="text" name="schEnd" value="<?php echo $row["ScheduleEnd"]?>" required><br>
    <input type="submit" value="Submit">
</form>
