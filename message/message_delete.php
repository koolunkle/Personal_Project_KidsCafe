<?php
// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// declare global variable
if (isset($_GET['mode']))
	$mode = $_GET['mode'];

$get_num = $_GET['num'];
$user_num = null;

// get function : alert_back
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

// check num and execute sql
if (isset($get_num)) {
	$user_num = mysqli_real_escape_string($connect, $get_num);

	if (empty($user_num)) {
		alert_back('no such user found');
		exit();
	} else {
		// sql - delete
		$sql_delete = "delete from message where num = $user_num";
		mysqli_query($connect, $sql_delete);
		mysqli_close($connect);

		$url = ($mode == "send") ? "http://{$_SERVER['HTTP_HOST']}/project/message/message_box.php?mode=send" : "http://{$_SERVER['HTTP_HOST']}/project/message/message_box.php?mode=rv";
		header("location: $url");
	}
}
?>