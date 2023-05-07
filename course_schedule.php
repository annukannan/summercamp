<?php
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Courses | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Course Schedule</h3>";
echo "<table border=1><tr><th>Course Schedule ID</th><th>Course Name</th><th>Schedule Name</th>
<th>Availability</th><th>Action</th><th>Action</th></tr>";
$sql = "select c.CourseID CourseID, CourseName, s.ScheduleId ScheduleID, ScheduleName, Course_Schedule_ID, Availability from course c, course_schedule cs, schedule s
where c.CourseID=cs.CourseID and cs.ScheduleID=s.ScheduleID;";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["Course_Schedule_ID"] . "</td>
             <td>" . $row["CourseName"] . "</td>
             <td>" . $row["ScheduleName"] . "</td>
            <td>" . $row["Availability"] . "</td>
            <td><a href='delete_course_schedule.php?courseScheduleID=" . $row["Course_Schedule_ID"] . "'>Delete</a>" . "</td>
            <td><a href='edit_course_schedule.php?courseScheduleID=" . $row["Course_Schedule_ID"] . "'>Update</a>"
          . "</td>
            </tr>";
    }
}
echo "</table>";
$conn->close();
?>
<a href="addcourse_schedule.php">Add New Course Schedule</a>