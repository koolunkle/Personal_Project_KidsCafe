<?php
// start session
session_start();

// declare global variable
$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";
$user_name = (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : "";

// get function : alert_back
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

// get function : escape_string
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/escape_string.php";

if (!$user_id) {
    alert_back('please login and use');
    exit();
}

// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

if (isset($_POST['mode']) && $_POST['mode'] === "delete") {
    $num = $_POST['num'];
    $page = $_POST['page'];

    $sql_select = "select * from image_post where num = $num";
    $result_set = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_array($result_set);

    $writer = $row['id'];
    $copied_name = $row['file_copied'];

    if (!isset($user_id) || ($user_id !== $writer && $user_level !== '1')) {
        alert_back('do not have permission to modify');
        exit();
    }

    if ($copied_name) {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . "/project/data/" . $copied_name;
        unlink($file_path);
    }

    // delete image_post
    $sql_delete_post = "delete from image_post where num = $num";
    mysqli_query($connect, $sql_delete_post);

    // delete image_post_reply
    $sql_delete_reply = "delete from image_post_reply where parent = $num";
    mysqli_query($connect, $sql_delete_reply);

    mysqli_close($connect);

    header("location: http://{$_SERVER['HTTP_HOST']}/project/image_board/image_board_list.php?page=$page");
} else if (isset($_POST['mode']) && $_POST['mode'] === "insert") {
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/project/data/";

    $upfile_name = $_FILES['upfile']['name'];
    $upfile_tmp_name = $_FILES['upfile']['tmp_name'];
    $upfile_type = $_FILES['upfile']['type'];
    $upfile_size = $_FILES['upfile']['size'];
    $upfile_error = $_FILES['upfile']['error'];

    // if upload file
    if ($upfile_name && !$upfile_error) {
        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext = $file[1];

        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name . "_" . $file_name;

        $copied_file_name = $new_file_name . "." . $file_ext;
        $uploaded_file = $upload_dir . $copied_file_name;

        if ($upfile_size > 1000000) {
            alert_back('file size exceeds specified capacity(1MB)<br>please check file size');
            exit();
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
            alert_back('failed to copy file to specified directory');
            exit();
        }
    } else {
        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";
    }

    $sql_insert = "insert into image_post (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
    $sql_insert .= "values('$user_id', '$user_name', '$subject', '$content', '$regist_day', 0, '$upfile_name', '$upfile_type', '$copied_file_name')";
    mysqli_query($connect, $sql_insert);

    // set_point
    $point_up = 100;

    $sql_select = "select point from members where id = '$user_id'";
    $result_set = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_array($result_set);
    $new_point = $row['point'] + $point_up;

    $sql_update = "update members set point = $new_point where id = '$user_id'";
    mysqli_query($connect, $sql_update);
    mysqli_close($connect);

    header("location: http://{$_SERVER['HTTP_HOST']}/project/image_board/image_board_list.php");
    exit();
} else if (isset($_POST['mode']) && $_POST['mode'] === "modify") {
    $num = $_POST['num'];
    $page = $_POST['page'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $file_delete = (isset($_POST['file_delete'])) ? $_POST['file_delete'] : "unchecked";

    $sql_select = "select * from image_post where num = $num";
    $result_set = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_array($result_set);

    $copied_name = $row['file_copied'];
    $upfile_name = $row['file_name'];
    $upfile_type = $row['file_type'];
    $copied_file_name = $row['file_copied'];

    // update title and content (except file)
    if (($file_delete !== "checked") && empty($_FILES['upfile']['name'])) {
        $sql_update = "update image_post set subject = '$subject', content = '$content' where num = $num";
        mysqli_query($connect, $sql_update);
    }
    // update title and content (delete origin file, not update new file)
    else if (($file_delete === "checked") && empty($_FILES['upfile']['name'])) {
        if ($copied_name) {
            $file_path = $_SERVER['DOCUMENT_ROOT'] . "/project/data/" . $copied_name;
            unlink($file_path);
        }

        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";

        $sql_update = "update image_post set subject = '$subject', content = '$content', file_name = '$upfile_name', file_type = '$upfile_type', file_copied = '$copied_file_name' where num = $num";
        mysqli_query($connect, $sql_update);
    } else {
        // update title and content (delete origin file, update new file)
        if ($copied_name) {
            $file_path = $_SERVER['DOCUMENT_ROOT'] . "/project/data/" . $copied_name;
            unlink($file_path);
        }

        $upfile_name = "";
        $upfile_type = "";
        $copied_file_name = "";

        if (isset($_FILES['upfile'])) {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/project/data/";

            $upfile_name = $_FILES['upfile']['name'];
            $upfile_tmp_name = $_FILES['upfile']['tmp_name'];
            $upfile_type = $_FILES['upfile']['type'];
            $upfile_size = $_FILES['upfile']['size'];
            $upfile_error = $_FILES['upfile']['error'];

            if ($upfile_name && !$upfile_error) {
                $file = explode(".", $upfile_name);
                $file_name = $file[0];
                $file_ext = $file[1];

                $new_file_name = date("Y_m_d_H_i_s");
                $new_file_name = $new_file_name . "_" . $file_name;
                $copied_file_name = $new_file_name . "." . $file_ext;
                $uploaded_file = $upload_dir . $copied_file_name;

                if ($upfile_size > 1000000) {
                    alert_back('file size exceeds specified capacity(1MB)<br>please check file size');
                    exit();
                }

                if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                    alert_back('failed to copy file to specified directory');
                    exit();
                }
            }
            $sql_update = "update image_post set subject = '$subject', content = '$content', file_name = '$upfile_name', file_type = '$upfile_type', file_copied = '$copied_file_name' where num = $num";
            mysqli_query($connect, $sql_update);
        }
    }
    header("location: http://{$_SERVER['HTTP_HOST']}/project/image_board/image_board_list.php?page=$page");
} else if (isset($_POST['mode']) && $_POST['mode'] == "insert_reply") {
    if (empty($_POST["reply_content"])) {
        alert_back('please enter your content');
        exit();
    }

    // set image board reply
    $reply_user_id = mysqli_real_escape_string($connect, $user_id);
    $sql_select = "select * from members where id = '$reply_user_id'";
    $result_set = mysqli_query($connect, $sql_select);

    if (!$result_set)
        die('error: ' . mysqli_error($connect));

    $row_count = mysqli_num_rows($result_set);

    if (!$row_count) {
        alert_back('id does not exist');
        exit();
    } else {
        $content = escape_string($_POST['reply_content']);
        $page = escape_string($_POST['page']);
        $parent = escape_string($_POST['parent']);
        $hit = escape_string($_POST['hit']);

        $reply_user_nickname = isset($_SESSION['user_nickname']) ? mysqli_real_escape_string($connect, $_SESSION['user_nickname']) : null;
        $reply_user_name = mysqli_real_escape_string($connect, $_SESSION['user_name']);
        $reply_content = mysqli_real_escape_string($connect, $content);
        $reply_parent = mysqli_real_escape_string($connect, $parent);
        $regist_day = date("Y-m-d (H:i)");

        $sql_insert = "insert into `image_post_reply` values (null, '$reply_parent', '$reply_user_id', '$reply_user_name', '$reply_user_nickname', '$reply_content', '$regist_day')";
        $result_insert = mysqli_query($connect, $sql_insert);

        if (!$result_insert)
            die('Error: ' . mysqli_error($connect));

        mysqli_close($connect);

        header("location: http://{$_SERVER['HTTP_HOST']}/project/image_board/image_board_view.php?num=$parent&page=$page&hit=$hit");
    }
} else if (isset($_POST['mode']) && $_POST['mode'] == "delete_reply") {
    $page = escape_string($_POST['page']);
    $hit = escape_string($_POST['hit']);
    $num = escape_string($_POST['num']);
    $parent = escape_string($_POST['parent']);
    $q_num = mysqli_real_escape_string($connect, $num);

    $sql_delete = "delete from `image_post_reply` where num = $q_num";
    $result = mysqli_query($connect, $sql_delete);

    if (!$result)
        die('Error: ' . mysqli_error($connect));

    mysqli_close($connect);

    header("location: http://{$_SERVER['HTTP_HOST']}/project/image_board/image_board_view.php?num=$parent&page=$page&hit=$hit");
}
?>