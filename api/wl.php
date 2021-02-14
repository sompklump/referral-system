<?php
/*
//
// Author: Ole Anton Hagen
// Purpose and made for Requiem Community
//
*/

require("../php/fivem_msql.php");
header('Content-Type: application/json');

// Don't show private information about the page
error_reporting(0);
ini_set('display_errors', 0);
ini_set('display_errors', 0);

$error = false;
$api_result = null;

$queryResult = (object) null;

if (isset($_GET["steamid"]) && isset($_GET["rank"]) && isset($_GET['name']) && isset($_GET["password"]) && isset($_GET["faction"])) {
	$fullName = urldecode($_GET['name']);
	$nameArr = explode(' ', $fullName);
	$sql = "SELECT * FROM users WHERE identifier = '{$_GET['steamid']}'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$sql = "SELECT * FROM jobs WHERE name = '{$_GET['faction']}'";
		$result = mysqli_query($conn, $sql);
		// If it returns with value then just update.
		if (mysqli_num_rows($result) > 0) {
			if ($_GET['password'] == "Weu80BU2rYMWRqs1A1aRUJHzXf77A6sL7J594X8hjDiIh" && $_GET['faction'] == "ambulance") {
				// If rank is less or equal to 0 then the rank set was none. Remove player form faction
				if (intval($_GET['rank']) <= 0) {
					$sql = "UPDATE users SET job = 'unemployed', job_grade = '0' WHERE identifier = '{$_GET['steamid']}' AND firstname = '{$nameArr[0]}' AND lastname = '{$nameArr[1]}'";
					$result = mysqli_query($conn, $sql);
					if (!mysqli_query($conn, $sql)) {
						$error = "Error in query";
					}
				}
				else {
					$rank = intval($_GET['rank']) - 1;
					$sql = "UPDATE users SET job = '{$_GET['faction']}', job_grade = '$rank' WHERE identifier = '{$_GET['steamid']}' AND firstname = '{$nameArr[0]}' AND lastname = '{$nameArr[1]}'";
					$result = mysqli_query($conn, $sql);
					if (!mysqli_query($conn, $sql)) {
						$error = "Error in query";
					}
				}
			}
		}
	} else {
		$error = "No user with {$_GET['steamid']}";
	}
}
$queryResult->error = $error;
echo json_encode($queryResult);