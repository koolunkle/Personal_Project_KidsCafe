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
                if (isset($_GET['page']))
                    $page = $_GET['page'];
                else
                    $page = 1;

                $scale = 5;

                $start = ($page - 1) * $scale;

                $mode = $_GET["mode"];

                if ($mode == "send")
                    echo "Send Message > View List";
                else
                    echo "Receive Message > View List";
                ?>
            </h3>

            <div>
                <ul id="message">
                    <li>
                        <span class="col1">No.</span>
                        <span class="col2">Title</span>

                        <span class="col3">
                            <?php
                            if ($mode == "send")
                                echo "Receiver";
                            else
                                echo "Sender";
                            ?>
                        </span>

                        <span class="col4">Registration</span>
                    </li>

                    <?php
                    // connect database
                    include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

                    // get total page
                    if ($mode == "send")
                        $sql_select = "select count(*) from message where send_id='$user_id' order by num desc";
                    else
                        $sql_select = "select count(*) from message where rv_id='$user_id' order by num desc";

                    $result_set = mysqli_query($connect, $sql_select);
                    $row = mysqli_fetch_array($result_set);
                    $total_record = intval($row[0]);
                    $total_page = ceil($total_record / $scale);

                    if ($mode == "send")
                        $sql_select = "select * from message where send_id='$user_id' order by num desc limit $start, $scale";
                    else
                        $sql_select = "select * from message where rv_id='$user_id' order by num desc limit $start, $scale";

                    $result_set = mysqli_query($connect, $sql_select);

                    $number = $total_record - $start;

                    while ($row = mysqli_fetch_array($result_set)) {
                        $num = $row['num']; // primary key
                        $subject = $row['subject'];
                        $regist_day = $row['regist_day'];
                        $regist_day = substr($regist_day, 0, 10);

                        if ($mode == "send")
                            $msg_id = $row['rv_id'];
                        else
                            $msg_id = $row['send_id'];

                        $result = mysqli_query($connect, "select name from members where id='$msg_id'");
                        $record = mysqli_fetch_array($result);
                        $msg_name = $record['name'];
                        ?>

                    <li>
                        <span class="col1">
                            <?= $number ?>
                        </span>

                        <span class="col2">
                            <a
                                href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/message/message_view.php?mode=<?= $mode ?>&num=<?= $num ?>">
                                <?= $subject ?>
                            </a>
                        </span>

                        <span class="col3">
                            <?= $msg_name ?>(<?= $msg_id ?>)
                        </span>

                        <span class="col4">
                            <?= $regist_day ?>
                        </span>
                    </li>

                    <?php
                        $number--;
                    }
                    mysqli_close($connect);
                    ?>
                </ul>

                <!-- move page -->
                <ul id="page_num">
                    <?php
                    // get function : get_paging_opt
                    include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/get_paging.php";

                    $url = "http://{$_SERVER['HTTP_HOST']}/project/message/message_box.php?mode=$mode";
                    echo get_paging_opt3($total_page, $page, $mode, $url);
                    ?>
                </ul>

                <ul class="buttons">
                    <li><button onclick="location.href='message_box.php?mode=rv'">Receive Message</button></li>
                    <li><button onclick="location.href='message_box.php?mode=send'">Send Message</button></li>
                    <li><button onclick="location.href='message_form.php'">Write</button></li>
                </ul>
            </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>