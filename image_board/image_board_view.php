<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/image_board.css">
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <div id="board_box">
            <h3 id="board_view_title">
                Image Post > View Content
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

            $num = $_GET['num'];
            $page = $_GET['page'];

            $sql_select = "select * from image_post where num = $num";
            $result_set = mysqli_query($connect, $sql_select);
            $row = mysqli_fetch_array($result_set);

            $id = $row['id'];
            $name = $row['name'];
            $regist_day = $row['regist_day'];

            $subject = $row['subject'];
            $content = $row['content'];

            $file_name = $row['file_name'];
            $file_type = $row['file_type'];
            $file_copied = $row['file_copied'];

            $hit = $row['hit'];
            $content = str_replace(" ", "&nbsp;", $content);
            $content = str_replace("\n", "<br>", $content);

            // set hit(view)
            if ($user_id !== $id) {
                $new_hit = $hit + 1;
                $sql_update = "update image_post set hit = $new_hit where num = $num";
                mysqli_query($connect, $sql_update);
            }

            $file_name = $row['file_name'];
            $file_copied = $row['file_copied'];
            $file_type = $row['file_type'];

            $image_max_width = 300;
            $image_max_height = 200;

            // inquiry image info > width, height, type
            if (!empty($file_name)) {
                $image_info = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/project/data/" . $file_copied);
                $image_width = $image_info[0];
                $image_height = $image_info[1];
                $image_type = $image_info[2];

                if ($image_width > $image_max_width)
                    $image_width = $image_max_width;

                if ($image_height > $image_max_height)
                    $image_height = $image_max_height;
            }
            ?>
            <ul id="view_content">
                <li>
                    <span class="col1"><b>Title : </b>
                        <?= $subject ?>
                    </span>

                    <span class="col2">
                        <?= $name ?> | <?= $regist_day ?>
                    </span>
                </li>

                <li>
                    <?php
                    if (strpos($file_type, "image") !== false) {
                        echo "<img src='http://{$_SERVER['HTTP_HOST']}/project/data/$file_copied' width='$image_width'><br>";
                    } else if ($file_name) {
                        $real_name = $file_copied;
                        $file_path = $data_dir . $real_name;
                        $file_size = filesize($file_path);

                        echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href='board_download.php?real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                    }
                    ?>
                    <?= $content ?>
                </li>
            </ul>

            <!-- set reply -->
            <div id="reply">
                <div id="reply1">Comment</div>

                <div id="reply2">
                    <?php
                    $sql_select = "select * from `image_post_reply` where parent = '$num'";
                    $reply_result = mysqli_query($connect, $sql_select);

                    while ($reply_row = mysqli_fetch_array($reply_result)) {
                        $reply_num = $reply_row['num'];
                        $reply_id = $reply_row['id'];
                        $reply_nick = $reply_row['nick'];
                        $reply_date = $reply_row['regist_day'];
                        $reply_content = $reply_row['content'];

                        $reply_content = str_replace("\n", "<br>", $reply_content);
                        $reply_content = str_replace(" ", "&nbsp;", $reply_content);
                        ?>

                    <div>
                        <ul>
                            <li>
                                <?= $reply_id . "&nbsp;&nbsp;" . $reply_date ?>
                            </li>

                            <li>
                                <?php
                                    // if admin or writer, grant delete permisson
                                    if ($_SESSION['user_id'] == "admin" || $_SESSION['user_id'] == $reply_id) {
                                        echo '
                                            <form style="display:inline" action="image_board_crud.php" method="post">
                                            <input type="hidden" name="page" value="' . $page . '">
                                            <input type="hidden" name="hit" value="' . $hit . '">
                                            <input type="hidden" name="mode" value="delete_reply">
                                            <input type="hidden" name="num" value="' . $reply_num . '">
                                            <input type="hidden" name="parent" value="' . $num . '">
                                            <span>' . $reply_content . '</span>
                                            <input id="input_delete" type="submit" value="Delete">
                                            </form>';
                                    } else {
                                        echo '
                                            <form style="display:inline" method="post">
                                            <span>' . $reply_content . '</span>
                                            </form>';
                                    }
                                    ?>
                            </li>
                        </ul>
                    </div>
                    <?php
                    }
                    mysqli_close($connect);
                    ?>

                    <form name="reply_form"
                        action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image_board/image_board_crud.php"
                        method="post">

                        <input type="hidden" name="mode" value="insert_reply">
                        <input type="hidden" name="parent" value="<?= $num ?>">
                        <input type="hidden" name="hit" value="<?= $hit ?>">
                        <input type="hidden" name="page" value="<?= $page ?>">

                        <div>
                            <div id="reply_textarea">
                                <textarea name="reply_content" rows="3" cols="80"></textarea>
                            </div>

                            <div id="reply_button">
                                <button>Input Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="write_button">
                <ul class="buttons">
                    <li>
                        <button onclick="location.href='image_board_list.php?page=<?= $page ?>'">List</button>
                    </li>

                    <li>
                        <form
                            action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image_board/image_board_modify_form.php"
                            method="post">

                            <button>Modify</button>

                            <input type="hidden" name="num" value=<?= $num ?>>
                            <input type="hidden" name="page" value=<?= $page ?>>
                            <input type="hidden" name="mode" value="modify">
                        </form>
                    </li>

                    <li>
                        <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image_board/image_board_crud.php"
                            method="post">

                            <button>Delete</button>

                            <input type="hidden" name="num" value=<?= $num ?>>
                            <input type="hidden" name="page" value=<?= $page ?>>
                            <input type="hidden" name="mode" value="delete">
                        </form>
                    </li>

                    <li>
                        <button onclick="location.href='image_board_form.php'">Write</button>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>