<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/image_board.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/image_board_form.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <?php
    // get function : alert_back
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

    if (!isset($user_id) || empty($user_id)) {
        alert_back('please login and use');
        exit();
    }
    ?>

    <section>
        <div id="board_box">
            <h3 id="board_title">
                Image Post > Write
            </h3>

            <!-- enctype="multipart/form-data" > required for file upload -->
            <form name="image_board_form" method="post"
                action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image_board/image_board_crud.php"
                enctype="multipart/form-data">

                <input type="hidden" name="mode" value="insert">

                <ul id="board_form">
                    <li>
                        <span class="col1">Name : </span>

                        <span class="col2">
                            <?= $user_name ?>
                        </span>
                    </li>

                    <li>
                        <span class="col1">Title : </span>
                        <span class="col2"><input type="text" name="subject"></span>
                    </li>

                    <li id="text_area">
                        <span class="col1">Content : </span>

                        <span class="col2">
                            <textarea name="content"></textarea>
                        </span>
                    </li>

                    <li id="attachment">
                        <span class="col1">Attachment</span>
                        <span class="col2"><input type="file" name="upfile"></span>
                    </li>
                </ul>

                <ul class="buttons">
                    <li><button type="button" onclick="check_form()">Save</button></li>
                    <li><button type="button" onclick="location.href='image_board_list.php'">List</button></li>
                </ul>
            </form>
        </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>