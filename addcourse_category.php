<?php
include "dbconn.php";

var_dump($_REQUEST);
$sql = "insert into course_category (CategoryID,CategoryType) VALUES (?,?)";
$catID = $_REQUEST["catID"];
$catType = $_REQUEST["catType"];

$stmt = $conn->prepare($sql);

$stmt->bind_param('is',$catID, $catType);

if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'course_category.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>