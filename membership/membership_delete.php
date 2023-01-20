<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css"
        href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/membership_delete.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/membership_delete.js"></script>
</head>

<body onload="set_membership_delete()">
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/project/header.php"; ?>
    </header>

    <?php
    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : "";

    // get function : alert_back
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

    if (!isset($user_id) || empty($user_id)) {
        alert_back('please login and use');
        exit();
    } else {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

        $sql_select = "select * from members where id = '$user_id'";
        $result_set = mysqli_query($connect, $sql_select);
        mysqli_fetch_assoc($result_set);

        if (mysqli_num_rows($result_set) > 0) {
            ?>

    <section>
        <h2>Membership Delete</h2>
        <hr>

        <div class="warning">
            <h3>회원탈퇴 신청 전 다음 유의사항을 확인해 주세요</h3>
            <ul>
                <li>개인정보 보호법에 의거하여 모든 개인정보가 삭제됩니다</li>
                <li>향후 홈페이지 로그인 및 서비스 이용이 제한됩니다</li>
            </ul>
        </div>

        <div class="button">
            <input type="button" id="submit" value="Delete">
        </div>
    </section>

    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php"; ?>
    </footer>
</body>

</html>
<?php
        } else {
            echo "<script>alert('please login and use');</script>";
            echo "<script>location.replace('/project/login/login_form.php');</script>";
            mysqli_close($connect);
            exit();
        }
    }
    ?>