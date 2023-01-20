<?php
$send_id = $_POST['send_id'];
$rv_id = $_POST['rv_id'];
$subject = $_POST['subject'];
$content = $_POST['content'];

// convert entity code (except trim, stripslashes)
// ENT_QUOTES : convert single or double quotation(quotes) to entity code
$subject = htmlspecialchars($subject, ENT_QUOTES);
$content = htmlspecialchars($content, ENT_QUOTES);

$regist_day = date("Y-m-d (H:i)");

// get function : alert_back
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

if (!isset($send_id) || empty($send_id)) {
	alert_back('please login and use');
	exit();
}

// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

$sql_select = "select * from members where id = '$rv_id'";
$result_set = mysqli_query($connect, $sql_select);
$num_record = mysqli_num_rows($result_set);

if ($num_record) {
	$sql_insert = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
	$sql_insert .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
	mysqli_query($connect, $sql_insert);
} else {
	alert_back('invalid receive id');
	exit();
}

mysqli_close($connect);

header("location: http://{$_SERVER['HTTP_HOST']}/project/message/message_box.php?mode=send");
?>