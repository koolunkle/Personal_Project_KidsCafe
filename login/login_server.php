<?php
// session start
session_start();

// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// declare global variable
$post_id = $_POST['id'];
$post_password = $_POST['password'];

$user_id = null;
$user_password = null;

// secure coding
if (isset($post_id) && isset($post_password)) {
  $user_id = mysqli_real_escape_string($connect, $post_id);
  $user_password = mysqli_real_escape_string($connect, $post_password);

  // check error
  if (empty($user_id)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/login/login_form.php?error=please enter your id");
    exit();
  } elseif (empty($user_password)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/login/login_form.php?error=please enter your password");
    exit();
  } else {
    // database - create / update / read / delete
    $sql_select = "select * from members where id = '$user_id'";
    $result_set = mysqli_query($connect, $sql_select);

    if (mysqli_num_rows($result_set) === 1) {
      $row = mysqli_fetch_assoc($result_set);
      $password_hash = $row['pass'];

      if (password_verify($user_password, $password_hash)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_level'] = $row['level'];
        $_SESSION['user_point'] = $row['point'];

        header("location: http://{$_SERVER['HTTP_HOST']}/project/main.php");
        exit();
      } else {
        header("location: http://{$_SERVER['HTTP_HOST']}/project/login/login_form.php?error=invalid password");
        exit();
      }
    } else {
      header("location: http://{$_SERVER['HTTP_HOST']}/project/login/login_form.php?error=invalid password");
      exit();
    }
  }
} else {
  header("location: http://{$_SERVER['HTTP_HOST']}/project/login/login_form.php?error=unknown error occured");
  exit();
}
?>