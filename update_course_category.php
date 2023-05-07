<?php
include "dbconn.php";

$sql = "update course_category set categoryType = ? where categoryID = ?";
//categoryID,categoryType

$catID = $_REQUEST["catID"];
$catType = $_REQUEST["catType"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $catType, $catID);


if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'course_category.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>