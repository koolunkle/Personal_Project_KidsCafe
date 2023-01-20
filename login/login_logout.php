<?php
// session start
session_start();

// secure coding
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  echo ("
  <script>
  alert('invalid access');
  location.href='http://{$_SERVER['HTTP_HOST']}/project/main.php';
  </script>");
  exit();
}

// session unset
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_level']);
unset($_SESSION['user_point']);

header("location: http://{$_SERVER['HTTP_HOST']}/project/main.php");
?>