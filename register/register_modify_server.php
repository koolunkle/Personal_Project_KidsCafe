<?php
// session start
session_start();

// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// declare global variable 
$post_id = $_POST['id'];
$post_password = $_POST['password'];
$post_password_confirm = $_POST['password_confirm'];
$post_name = $_POST['name'];
$post_email = $_POST['email'];

$user_id = null;
$user_password = null;
$user_password_confirm = null;
$user_name = null;
$user_email = null;

// secure coding
if (isset($post_id) && isset($post_password) && isset($post_password_confirm) && isset($post_name) && isset($post_email)) {
  $user_id = mysqli_real_escape_string($connect, $_POST['id']);
  $user_password = mysqli_real_escape_string($connect, $_POST['password']);
  $user_password_confirm = mysqli_real_escape_string($connect, $_POST['password_confirm']);
  $user_name = mysqli_real_escape_string($connect, $_POST['name']);
  $user_email = mysqli_real_escape_string($connect, $_POST['email']);

  // check error
  if (empty($user_password)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=please enter your password");
    exit();
  } elseif (empty($user_password_confirm)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=please enter your password confirm");
    exit();
  } elseif ($user_password !== $user_password_confirm) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=password does not match");
    exit();
  } elseif (empty($user_name)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=please enter your name");
    exit();
  } elseif (empty($user_email)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=please enter your email");
    exit();
  } else {
    // encrypt password
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);

    // database - create / update / read / delete
    $sql_select = "select * from members where id = '$user_id'";
    $result_set = mysqli_query($connect, $sql_select);

    if (!mysqli_num_rows($result_set) == 1) {
      header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=id does not exist");
      exit();
    } else {
      $sql_update = "update members set pass = '$user_password', name = '$user_name', email = '$user_email' where id = '$post_id'";
      $result = mysqli_query($connect, $sql_update);

      if ($result) {
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;

        header("location: http://{$_SERVER['HTTP_HOST']}/project/main.php?success=modifying information successful");
        exit();
      } else {
        header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=modifying informantion failed");
        exit();
      }
    }
  }
} else {
  header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_modify_form.php?error=unknown error occurred");
  exit();
}
?>