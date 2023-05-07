<?php

session_start();

if(isset($_SESSION['UserID']))
{
    echo ' Welcome ' . $_SESSION['UserID'].'<br/>';
}
else
{
    header("location:user_login.php");
}
include "dbconn.php";

	$id = $_REQUEST["courseScheduleID"];
	$UserID = $_SESSION['UserID'];

	try{
			$sql_withdraw = "DELETE from user_course where UserId=? and Course_Schedule_ID=?";
					
			$stmt = $conn->prepare($sql_withdraw);
			$stmt->bind_param("si", $UserID,$id);
			if($stmt->execute() === TRUE) {
				echo "<script>window.location.href = 'course_schedule_availability_report.php'</script>";
			}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
	}catch(err){
        echo '<script>alert("Inside error")</script>';  
	}

$conn->close();
?>


