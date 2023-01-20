<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/message.css">
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- set message box -->
        <div id="message_box">
            <h3>

                <?php
                // connect database
                include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

                // declare global variable
                $mode = $_GET['mode'];
                $num = $_GET['num'];

                $sql_select = "select * from message where num=$num";
                $result_set = mysqli_query($connect, $sql_select);
                $row = mysqli_fetch_array($result_set);

                $send_id = $row['send_id'];
                $rv_id = $row['rv_id'];
                $regist_day = $row['regist_day'];
                $subject = $row['subject'];
                $content = $row['content'];

                // html code : even if there is more than one white-space, it is accepted as one
                $content = str_replace(" ", "&nbsp;", $content);
                $content = str_replace("\n", "<br>", $content);

                if ($mode == "send")
                    $result2 = mysqli_query($connect, "select name from members where id='$rv_id'");
                else
                    $result2 = mysqli_query($connect, "select name from members where id='$send_id'");

                $record = mysqli_fetch_array($result2);
                $msg_name = $record['name'];

                if ($mode == "send")
                    echo "Send Message > View Content";
                else
                    echo "Receive Message > View Content";

                mysqli_close($connect);
                ?>
            </h3>

            <ul id="view_content">
                <li>
                    <span class="col1">
                        <b>Title :</b>
                        <?= $subject ?>
                    </span>

                    <span class="col2">
                        <?= $msg_name ?> | <?= $regist_day ?>
                    </span>
                </li>

                <li>
                    <?= $content ?>
                </li>
            </ul>

            <ul class="buttons">
                <li><button onclick="location.href='message_box.php?mode=rv'">Receive Message</button></li>
                <li><button onclick="location.href='message_box.php?mode=send'">Send Message</button></li>

                <li>
                    <button onclick="location.href='message_response_form.php?num=<?= $num ?>'">Reply Message</button>
                </li>

                <li>
                    <button
                        onclick="location.href='message_delete.php?num=<?= $num ?>&mode=<?= $mode ?>'">Delete</button>
                </li>
            </ul>
        </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>