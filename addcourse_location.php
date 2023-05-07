<?php
include "dbconn.php";

var_dump($_REQUEST);
$sql = "insert into course_location (LocationID,LocationName,City, State, Country) VALUES (?,?,?,?,?)";
$locID = $_REQUEST["locID"];
$locName = $_REQUEST["locName"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$country = $_REQUEST["country"];

$stmt = $conn->prepare($sql);

$stmt->bind_param('issss',$locID, $locName, $city, $state, $country);
//$stmt->execute();
//printf("%d row inserted.\n", $stmt->affected_rows);

if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'course_location.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>