<?php
/*
//
// Author: Ole Anton Hagen
// Purpose and made for Requiem Community
//
*/

require("../php/msql.php");
header('Content-Type: application/json');

// Don't show private information about the page
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_errors', 0);

$error = false;
$api_result = null;

$queryResult = (object) null;

if(isset($_GET["q"])){
	$apiQuery = $_GET["q"];
	if($apiQuery == "links"){
		$links = [];
		$sql = "SELECT * FROM invites WHERE last_used >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND times_used != 0";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)){
				array_push($links, $row['referral_link']);
			}
			$queryResult->links = $links;
		}
	}
}
echo json_encode($queryResult);
?>