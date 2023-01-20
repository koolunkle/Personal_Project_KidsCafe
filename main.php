<?php
// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_statement.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/917f9868b4.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/main.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/main.js"></script>
</head>

<body onload="set_slide_show()">
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/section.php" ?>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>