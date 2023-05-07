<?php
header("Cache-Control: no-cache");
$servername = "localhost";
$username = "mydb_user";
$password = "Ofallon!2";
$dbname = "mydb1";
$conn = new mysqli($servername,$username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
