<?php
$connect = mysqli_connect("localhost", "root", "4fkdgoehd@");
if (!$connect)
  die("database connect fail" . mysqli_connect_errno());

// verify that the database(practice) has been created
$database_flag = false;
$sql = "show databases";
$result = mysqli_query($connect, $sql) or die("database connect failed" . mysqli_error($connect));

while ($row = mysqli_fetch_array($result)) {
  // key : Database or index 0
  if ($row["Database"] == "practice") {
    $database_flag = true;
    break;
  }
}

// if the database does not exist ($database_flag == false)
if (!$database_flag) {
  $sql = "create database practice";
  $result = mysqli_query($connect, $sql) or die("database connect failed" . mysqli_error($connect));

  if ($result == true)
    echo "<script>alert('database has been created')</script>";
}

// connect database
$database_connect = mysqli_select_db($connect, "practice") or die("database connect failed" . mysqli_error($connect));
// $database_connet == false
if (!$database_connect)
  echo "<script>alert('database connect failed')</script>";
?>