<?php
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Courses | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Schedule</h3>";
echo "<table border=1><tr><th>Schedule ID</th><th>Schedule Name</th><th>Schedule Start</th>
<th>Schedule End</th><th>Action</th><th>Action</th></tr>";
$sql = "select ScheduleID, ScheduleName, ScheduleStart, ScheduleEnd from schedule";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["ScheduleID"] . "</td>
            <td>" . $row["ScheduleName"] . "</td>
            <td>" . $row["ScheduleStart"] . "</td>
            <td>" . $row["ScheduleEnd"] . "</td>
            <td><a href='delete_schedule.php?schID=" . $row["ScheduleID"] . "'>Delete</a>" . "</td>
            <td><a href='edit_schedule.php?schID=" . $row["ScheduleID"] . "'>Update</a>"
          . "</td>
            </tr>";
    }
}
echo "</table>";
$conn->close();
?>
<a href="addschedule.php">Add New Schedule</a>