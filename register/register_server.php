<?php
// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// declare global variable
$id = $_POST['id'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$name = $_POST['name'];
$email = $_POST['email'];

$user_id = null;
$user_password = null;
$user_password_confirm = null;
$user_name = null;
$user_email = null;

$regist_day = date("Y-m-d (H:i)");

// secure coding
if (isset($id) && isset($password) && isset($password_confirm) && isset($name) && isset($email)) {
  $user_id = mysqli_real_escape_string($connect, $id);
  $user_password = mysqli_real_escape_string($connect, $password);
  $user_password_confirm = mysqli_real_escape_string($connect, $password_confirm);
  $user_name = mysqli_real_escape_string($connect, $name);
  $user_email = mysqli_real_escape_string($connect, $email);

  // check error
  if (empty($user_id)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=please enter your id");
    exit();
  } elseif (empty($user_password)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=please enter your password");
    exit();
  } elseif (empty($user_password_confirm)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=please enter your password confirm");
    exit();
  } elseif ($user_password !== $user_password_confirm) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=password does not match");
    exit();
  } elseif (empty($user_name)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=please enter your name");
    exit();
  } elseif (empty($user_email)) {
    header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=please enter your email");
    exit();
  } else {
    // encrypt password
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);

    // database - create / update / read / delete
    $sql_select = "select * from members where id = '$user_id' or email = '$user_email'";
    $record_set = mysqli_query($connect, $sql_select);

    if (mysqli_num_rows($record_set) > 0) {
      header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=id and email already exist&id=$user_id&email=$user_email");
      exit();
    } else {
      $sql_insert = "insert into members(id, pass, name, email, regist_day, level, point)";
      $sql_insert .= "values('$id', '$user_password', '$name', '$email', '$regist_day', 9, 0)";
      $result_set = mysqli_query($connect, $sql_insert);

      if ($result_set) {
        header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?success=registration successful");
        exit();
      } else {
        header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?error=registration failed");
        exit();
      }
    }
  }
} else {
  header("location: http://{$_SERVER['HTTP_HOST']}/project/register/register_form.php?success=unknown error occurred");
  exit();
}
?>