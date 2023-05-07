<?php
include "dbconn.php";

$sql = "update course_location set LocationName = ?,City = ?, State= ?, Country = ? where LocationID = ?";
//LocationID,LocationName,City, State, Country

$locID = $_REQUEST["locID"];
$locName = $_REQUEST["locName"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$country = $_REQUEST["country"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $locName, $city, $state,$country, $locID);
//$stmt->execute(); 

//printf("%d rows updated.\n", $stmt->affected_rows);

if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'course_location.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>