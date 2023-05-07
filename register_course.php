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

	$sql_max_usercourse_id = "SELECT MAX(User_Course_ID) as maxCnt from user_course";
	try{
		$result = $conn->query($sql_max_usercourse_id);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$nextId = $row["maxCnt"]+1;
			$sql_select = "SELECT * from user_course where UserId=? and Course_Schedule_ID=?";
					
			$stmt = $conn->prepare($sql_select);
			$stmt->bind_param("si", $UserID,$id);
			$stmt->execute();
			$result = $stmt->get_result();

			if($result->num_rows > 0) {
				echo '<script>alert("User is already registered to this course")</script>';
			} else {
				$sql_insert = "INSERT INTO `user_course`(`User_Course_ID`, `Course_Schedule_ID`, `UserID`)
					VALUES ($nextId,'$id', '$UserID')";
				if(mysqli_query($conn,$sql_insert)){
						echo '<script>alert("Course registered successfully")</script>';                 
				}else{
					//echo '<script>alert("Inside else")</script>';    
					if (mysqli_errno($conn) == 1062) {  
						echo '<script>alert("User is already registered to this course")</script>';
					} else {
						echo '<script>alert("DB Insert Error")</script>';
					}
				}
			}
 
			echo "<script>window.location.href = 'course_schedule_availability_report.php'</script>";
		}
	}catch(err){
        echo '<script>alert("Inside error")</script>';  
	}

$conn->close();
?>


