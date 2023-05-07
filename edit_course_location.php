<?php
include "dbconn.php";

$sql = "SELECT * FROM course_location where LocationID = ?";
$id = $_REQUEST["locID"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}

?>
<form action="update_course_location.php">
    <label for "locName">Location name:</label><br>
    <input type="text" id="locName" name="locName" value="<?php echo $row["LocationName"]?>"><br>
    <label for "city">City:</label><br>
    <input type="text" id="city" name="city" value="<?php echo $row["City"]?>"><br>
    <label for "state">State:</label><br>
    <input type="text" id="state" name="state" value="<?php echo $row["State"]?>"><br>
    <label for "country">Country:</label><br>
    <input type="text" id="country" name="country" value="<?php echo $row["Country"]?>"><br>
    <input type="hidden" id="locID" name="locID"  value="<?php echo $row["LocationID"]?>"><br>
    <input type="submit" value="Submit">
</form>