<?php
// start session
session_start();

// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// check session and declare global variable
$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";

// get function : alert_back
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

if (!isset($user_id) || empty($user_id)) {
    alert_back('please login and use');
    exit();
} else {
    // verify actual member
    $sql_select = "select * from members where id = '$user_id'";
    $result_set = mysqli_query($connect, $sql_select);

    // if id exist
    if (mysqli_num_rows($result_set) > 0) {
        $sql_delete = "delete from members where id = '$user_id'";
        $result = mysqli_query($connect, $sql_delete);

        // if result is success, execute unset
        if ($result) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);

            echo "<script>alert('thank you for using it');</script>";
            echo "<script>location.replace('/project/main.php');</script>";
        } else {
            echo "<script>alert('no such information found');</script>";
            echo "<script>location.replace('/project/main.php');</script>";
            exit();
        }
    } else {
        echo "<script>alert('no such information found');</script>";
        echo "<script>location.replace('/project/main.php');</script>";
        exit();
    }
}
mysqli_close($connect);
?>