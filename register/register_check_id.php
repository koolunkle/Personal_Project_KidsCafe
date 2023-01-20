<?php
// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// declare global variable
$get_id = $_GET['id'];
$user_id = null;
$message = null;

if (isset($get_id)) {
  $user_id = mysqli_real_escape_string($connect, $get_id);

  if (empty($get_id))
    $message = ("<li>please enter your id</li>");
  else {
    $sql_select = "select * from members where id = '$user_id'";
    $result = mysqli_query($connect, $sql_select);

    if (mysqli_num_rows($result) == 1) {
      $message = "<li>" . $user_id . " is duplicate id</li>";
      $message .= "<li>please enter different id</li>";
    } else
      $message = "<li>" . $user_id . " is available id</li>";

    mysqli_close($connect);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register ID Check</title>

    <style>
    body {
        text-align: center;
    }

    h3 {
        padding-left: 0.3rem;
        border-left: 5px solid #edbf07;
    }

    #close {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <h3>Duplicate ID Check</h3>

    <p>
        <?= $message ?>
    </p>

    <button id="close" onclick="javascript:self.close()">Close</button>
</body>

</html>