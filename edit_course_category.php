<?php
include "dbconn.php";

$sql = "SELECT * FROM course_category where CategoryID = ?";
$id = $_REQUEST["catID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}

?>
<form action="update_course_category.php">
    <label for "catType">Category Type:</label><br>
    <input type="text" id="catType" name="catType" value="<?php echo $row["CategoryType"]?>"><br>
    <input type="hidden" id="catID" name="catID"  value="<?php echo $row["CategoryID"]?>"><br>
    <input type="submit" value="Submit">
</form>