<?php
include "dbconn.php";
$sql = "delete from course_category where CategoryID=?";
$id = $_REQUEST["catID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'course_category.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>