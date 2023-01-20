<?php
// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";
// get function : alert back
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

$mode = $_POST['mode'];

// if mode is 'write'
if ($mode === "Write") {
  if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['written_date'])) {
    $num = "null";

    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $content = mysqli_real_escape_string($connect, $_POST['content']);
    $written_date = mysqli_real_escape_string($connect, date('Y-m-d H:i:s', time()));

    $read_count = 1;
    $special_symbol = '"/[`~!@#$%^&*|\\\'\";:\/?^=^+_()<>]/"';

    if (empty($title)) {
      alert_back("title is empty");
      exit();
    } elseif (empty($content)) {
      alert_back("content is empty");
      exit();
    } else {
      // if special symbol exists
      if (preg_match($special_symbol, $title)) {
        alert_back("special symbols are not allowed");
        exit();
      }
      $sql_insert = "insert into notice(num, title, content, written_date, read_count) values($num, '$title', '$content', '$written_date', '$read_count')";
      mysqli_query($connect, $sql_insert);
      mysqli_close($connect);

      header("location: http://{$_SERVER['HTTP_HOST']}/project/service/service_notice.php");
      exit();
    }
  }
}
// if mode is 'modify'
elseif ($mode === "Modify") {
  if (isset($_POST['title']) && isset($_POST['content'])) {
    $num = mysqli_real_escape_string($connect, $_POST['num']);
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $content = mysqli_real_escape_string($connect, $_POST['content']);

    $special_symbol = "'/[`~!@#$%^&*|\\\'\";:\/?^=^+_()<>]/'";

    // if special symbol exists
    if (preg_match($special_symbol, $title)) {
      alert_back("special symbols are not allowed");
      exit();
    }
    if (empty($title)) {
      alert_back("title is empty");
      exit();
    } elseif (empty($content)) {
      alert_back("content is empty");
      exit();
    } else {
      $sql_update = "update notice set title = '$title', content = '$content' where num = $num";
      mysqli_query($connect, $sql_update);
      mysqli_close($connect);

      header("location: http://{$_SERVER['HTTP_HOST']}/project/service/service_notice.php");
      exit();
    }
  }
}
// if mode is 'delete'
elseif ($mode === "Delete") {
  if (isset($_POST['title']) && isset($_POST['content'])) {
    $num = mysqli_real_escape_string($connect, $_POST['num']);
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $content = mysqli_real_escape_string($connect, $_POST['content']);

    $sql_delete = "delete from notice where num = $num";
    $result = mysqli_query($connect, $sql_delete);
    mysqli_close($connect);

    header("location: http://{$_SERVER['HTTP_HOST']}/project/service/service_notice.php");
    exit();
  }
}
?>