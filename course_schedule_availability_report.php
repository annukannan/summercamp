<?php

session_start();

if(isset($_SESSION['UserID']))
{
    echo ' Welcome ' . $_SESSION['UserID'].'<br/>';
}
else
{
    header("location:user_login.php");
}
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Courses | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Course Registration</h3>";
echo "<table border=1><tr><th>Course Name</th><th>Schedule Name</th>
<th>Location Name</th><th>City</th><th>State</th>
<th>Total Seats</th><th>Available Seats</th><th>Category Type</th><th>Register</th></tr>";
$sql = "select Course_Schedule_ID,CourseName, ScheduleName, cl.LocationName, cl.City, cl.State, Availability, CourseAvailability(Course_Schedule_ID) as Remaining,CategoryType
from course c, course_schedule cs, schedule s, course_location cl, course_category cc
where c.CourseID=cs.CourseID and cs.ScheduleID=s.ScheduleID and c.LocationID=cl.LocationID and cc.CategoryID=c.CategoryID";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CourseName"] . "</td>
             <td>" . $row["ScheduleName"] . "</td>
             <td>" . $row["LocationName"] . "</td>
             <td>" . $row["City"] . "</td>
             <td>" . $row["State"] . "</td>
             <td>" . $row["Availability"] . "</td>
             <td>" . $row["Remaining"] . "</td>
             <td>" . $row["CategoryType"] . "</td>
            <td> ";
            if ($row["Remaining"] != 0) {
                echo "<a href='register_course.php?courseScheduleID=" . $row["Course_Schedule_ID"] . "'>Register</a>";
            } else {
                echo "No Spots Available to Register.";
            }
            echo "
            </td>
            </tr>";
    }
}
echo "</table>";

echo "<h3>U.S. Tech Summer Camp </h3>";
echo "<h4>" .$_SESSION['UserID']." - Registered Courses </h4>";
echo "<table border=1><tr>
<th>Course Name</th><th>Schedule Name</th>
<th>Location Name</th><th>City</th><th>State</th>
<th>Category Type</th><th>Manage</th></tr>";
$sql = "select UserID, User_Course_ID, uc.Course_Schedule_ID,CourseName, ScheduleName, cl.LocationName, cl.City, cl.State,CategoryType
from user_course uc, course c, course_schedule cs, schedule s, course_location cl, course_category cc
where UserId=? and uc.Course_Schedule_ID=cs.Course_Schedule_ID and c.CourseID=cs.CourseID and cs.ScheduleID=s.ScheduleID 
and c.LocationID=cl.LocationID and cc.CategoryID=c.CategoryID";

$userId = $_SESSION['UserID'];
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CourseName"] . "</td>
             <td>" . $row["ScheduleName"] . "</td>
             <td>" . $row["LocationName"] . "</td>
             <td>" . $row["City"] . "</td>
             <td>" . $row["State"] . "</td>
             <td>" . $row["CategoryType"] . "</td>
             <td> <a href='withdraw_course.php?courseScheduleID=" . $row["Course_Schedule_ID"] . "'>Withdraw</a></td>
            </tr>";
    }
}
echo "</table>";



$conn->close();
?>