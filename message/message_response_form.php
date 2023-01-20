<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/message.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/message_response_form.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- set message box -->
        <div id="message_box">
            <h3 id="write_title">Reply Message</h3>

            <?php
            // connect database
            include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

            // declare global variable
            $num = $_GET["num"];

            // sql - select
            $sql_select = "select * from message where num=$num";
            $result_set = mysqli_query($connect, $sql_select);
            $row = mysqli_fetch_array($result_set);

            $send_id = $row['send_id'];
            $rv_id = $row['rv_id'];

            $subject = $row['subject'];
            $subject = "RE: " . $subject;

            $content = $row['content'];
            $content = "> " . $content;
            $content = str_replace("\n", "\n>", $content);
            $content = "\n\n\n-----------------------------------------------\n" . $content;

            $result = mysqli_query($connect, "select name from members where id='$send_id'");
            $record = mysqli_fetch_array($result);
            $send_name = $record['name'];
            ?>

            <!-- set message form -->
            <form name="message_form" method="post"
                action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/message/message_server.php">

                <input type="hidden" name="rv_id" value="<?= $send_id ?>">
                <input type="hidden" name="send_id" value="<?= $user_id ?>">

                <div id="write_msg">
                    <ul>
                        <li>
                            <span class="col1">Sender :</span>

                            <span class="col2">
                                <?= $user_id ?>
                            </span>
                        </li>

                        <li>
                            <span class="col1">Receive ID : </span>
                            <span class="col2"><?= $send_name ?>(<?= $send_id ?>)</span>
                        </li>

                        <li>
                            <span class="col1">Title :</span>

                            <span class="col2">
                                <input name="subject" type="text" value="<?= $subject ?>">
                            </span>
                        </li>

                        <li id="text_area">
                            <span class="col1">Content :</span>

                            <span class="col2">
                                <textarea name="content"><?= $content ?></textarea>
                            </span>
                        </li>
                    </ul>

                    <!-- set submit button -->
                    <button type="button" onclick="check_form()">Send</button>
                </div>
            </form>
        </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>