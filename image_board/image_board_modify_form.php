<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/image_board.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/image_board_modify_form.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <div id="board_box">
            <h3 id="board_title">
                Image Post > Modify
            </h3>

            <?php
            // get function : alert_back
            include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/alert_back.php";

            if (!$user_id) {
                alert_back('please login and use');
                exit();
            }

            // connect database
            include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

            if (isset($_POST['mode']) && $_POST['mode'] === "modify") {
                $num = $_POST['num'];
                $page = $_POST['page'];

                $sql_select = "select * from image_post where num = $num";
                $result_set = mysqli_query($connect, $sql_select);
                $row = mysqli_fetch_array($result_set);

                $writer = $row["id"];
                $name = $row['name'];
                $subject = $row['subject'];
                $content = $row['content'];
                $file_name = $row['file_name'];

                // no session, writer and admin
                if (!isset($user_id) || ($user_id !== $writer && $user_level !== '1')) {
                    alert_back('do not have permission to modify');
                    exit();
                }

                if (empty($file_name))
                    $file_name = "no attachment";
            }
            ?>

            <!-- enctype="multipart/form-data" : required for file upload -->
            <form name="image_board_form" method="post"
                action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image_board/image_board_crud.php"
                enctype="multipart/form-data">

                <input type="hidden" name="mode" value="modify">
                <input type="hidden" name="num" value=<?= $num ?>>
                <input type="hidden" name="page" value=<?= $page ?>>

                <ul id="board_form">
                    <li>
                        <span class="col1">Name : </span>

                        <span class="col2">
                            <?= $user_name ?>
                        </span>
                    </li>

                    <li>
                        <span class="col1">Title : </span>
                        <span class="col2"><input type="text" name="subject" value='<?= $subject ?>'></span>
                    </li>

                    <li id="text_area">
                        <span class="col1">Content : </span>

                        <span class="col2">
                            <textarea name="content"><?= $content ?></textarea>
                        </span>
                    </li>

                    <li>
                        <span class="col1">Existing Attachment : </span>

                        <span class="col2">
                            <?= $file_name ?>
                            <?php if ($file_name !== "no attachment") { ?>
                            <input id="checkbox" type="checkbox" name="file_delete" value="checked">&nbsp;Delete
                            <?php } ?>
                        </span>
                    </li>

                    <li id="new_attachment">
                        <span class="col1">New<br>Attachment : </span>
                        <span class="col2"><input type="file" name="upfile"></span>
                    </li>
                </ul>

                <ul class="buttons">
                    <li><button type="button" onclick="check_form()">Modify</button></li>
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