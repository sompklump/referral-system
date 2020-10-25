<?php
//Declare credentials
$servername = "185.182.57.21";
$username = "requiem_referrals";
$password = "MvEP8W0T2IYr5QAZkRnhOfBVST7Xd1Q8PJQHcDzIXtT2Xce7qV";
$db = "requiem_referrals";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
$error = null;
//Check connection
if(!$conn){
	die("Connection database failed: " . $conn->connect_error);
}
//echo "Connection established!";
?>
