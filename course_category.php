<?php
include "dbconn.php";
echo "<head> <title>Tech Summer Camp Categories | Held at 150+ Prestigious Campuses</title></head>";
echo "<h3>U.S. Tech Summer Camp Categories</h3>";
echo "<table border=1><tr><th>Category ID</th><th>Category Type</th><th>Action</th><th>Action</th></tr>";
$sql = "select * from course_category";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["CategoryID"] . "</td>
            <td>" . $row["CategoryType"] . "</td>
            <td><a href='delete_course_category.php?catID=" . $row["CategoryID"] . "'>Delete</a>" . "</td>
            <td><a href='edit_course_category.php?catID=" . $row["CategoryID"] . "'>Update</a>"
          . "</td>
            </tr>";
    }
}
echo "</table>";
$conn->close();
?>
<a href="addcourse_category.htm">Add New Course Category</a>