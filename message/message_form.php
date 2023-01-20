<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/message.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/message_form.js"></script>
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
        <!-- set message box -->
        <div id="message_box">
            <h3 id="write_title">Send Message</h3>

            <!-- set message button -->
            <ul class="top_buttons">
                <li>
                    <span>
                        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/message/message_box.php?mode=rv">
                            Receive Message
                        </a>
                    </span>
                </li>

                <li>
                    <span>
                        <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/message/message_box.php?mode=send">
                            Send Message
                        </a>
                    </span>
                </li>
            </ul>

            <!-- set message form -->
            <form name="message_form" method="post"
                action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/message/message_server.php">

                <div id="write_msg">
                    <ul>
                        <li>
                            <span class="col1">Sender :</span>

                            <span class="col2">
                                <input type="text" name="send_id" value="<?= $user_id ?>" readonly>
                            </span>
                        </li>

                        <li>
                            <span class="col1">Receive ID : </span>
                            <span class="col2"><input name="rv_id" type="text"></span>
                        </li>

                        <li>
                            <span class="col1">Title : </span>
                            <span class="col2"><input name="subject" type="text"></span>
                        </li>

                        <li id="text_area">
                            <span class="col1">Content :</span>
                            <span class="col2"><textarea name="content"></textarea></span>
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