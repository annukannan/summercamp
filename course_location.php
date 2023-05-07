<?php
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Locations | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Locations</h3>";
echo "<table border=1><tr><th>Location ID</th><th>Location Name</th><th>City</th><th>State</th><th>Country</th><th>Action</th><th>Action</th></tr>";
$sql = "select * from course_location";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["LocationID"] . "</td>
            <td>" . $row["LocationName"] . "</td>
            <td>" . $row["City"] . "</td>
            <td>" . $row["State"] . "</td>
            <td>" . $row["Country"] . "</td>
            <td><a href='delete_course_location.php?locID=" . $row["LocationID"] . "'>Delete</a>" . "</td>
            <td><a href='edit_course_location.php?locID=" . $row["LocationID"] . "'>Update</a>"
          . "</td>
            </tr>";
    }
}
echo "</table>";
$conn->close();
?>
<a href="addcourse_location.htm">Add New Camp Location</a>