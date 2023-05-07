<?php
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Courses | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Courses</h3>";
echo "<table border=1><tr><th>Course ID</th><th>Course Name</th><th>Location Name</th>
<th>City</th><th>State</th><th>Category Type</th><th>Action</th><th>Action</th></tr>";
$sql = "select CourseID, CourseName, LocationName, City, State, CategoryType from course, course_category, course_location 
where course.CategoryID=course_category.CategoryID and course.LocationID=course_location.LocationID";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CourseID"] . "</td>
            <td>" . $row["CourseName"] . "</td>
            <td>" . $row["LocationName"] . "</td>
            <td>" . $row["City"] . "</td>
            <td>" . $row["State"] . "</td>
            <td>" . $row["CategoryType"] . "</td>
            <td><a href='delete_course.php?courseID=" . $row["CourseID"] . "'>Delete</a>" . "</td>
            <td><a href='edit_course.php?courseID=" . $row["CourseID"] . "'>Update</a>"
          . "</td>
            </tr>";
    }
}
echo "</table>";
$conn->close();
?>
<a href="addcourse.php">Add New Course</a>