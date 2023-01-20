<?php
// start session
session_start();

// ternary operator
$user_level = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : "";

// get function : alert_back
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

if ($user_level != 1) {
  alert_back('only admin can modify or delete information');
  exit();
}

// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// set mode
$mode = $_GET['mode'];

switch ($mode) {
  case "update":
    $num = $_POST['num'];
    $level = $_POST['level'];
    $point = $_POST['point'];

    $sql_update = "update members set level = $level, point = $point where num = $num";
    $result = mysqli_query($connect, $sql_update);

    if ($result)
      alert_back('update successful');
    else
      alert_back('update failed');

    break;

  case "delete":
    if (isset($_GET['num']))
      $num = $_GET['num'];

    $sql_delete = "delete from members where num = $num";
    $result = mysqli_query($connect, $sql_delete);

    if ($result)
      alert_back('select post to delete');
    else
      alert_back('delete failed');

    break;

  case "board_delete":
    $num_item = 0;

    if (isset($_POST['item']))
      $num_item = count($_POST['item']);
    else
      alert_back('select image_post to delete');

    $result = null;

    for ($i = 0; $i < $num_item; $i++) {
      $num = $_POST['item'][$i];

      $sql_select = "select * from image_post where num = $num";
      $result_set = mysqli_query($connect, $sql_select);
      $row = mysqli_fetch_array($result_set);
      $copied_name = $row['file_copied'];

      if ($copied_name) {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . "/project/data/" . $copied_name;
        unlink($file_path);
      }

      $sql_delete = "delete from image_post where num = $num";
      $result = mysqli_query($connect, $sql_delete);
    }

    if ($result)
      alert_back('delete successful');
    else
      alert_back('delete failed');

    break;
}
mysqli_close($connect);
?>