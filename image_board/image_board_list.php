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
            <h3 id="board_list_title">
                Image Post > View List
            </h3>

            <ul id="board_list">
                <?php
                // connect database
                include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

                if (isset($_GET['page']))
                    $page = $_GET['page'];
                else
                    $page = 1;

                $sql_select = "select count(*) from image_post order by num desc";
                $result_set = mysqli_query($connect, $sql_select);
                $row = mysqli_fetch_array($result_set);
                $total_record = intval($row[0]);

                $scale = 3;
                $total_page = ceil($total_record / $scale);

                // calculate start page
                $start = ($page - 1) * $scale;

                // declare array to store current page record result
                $list = array();

                $sql_select = "select * from image_post order by num desc limit $start, $scale";
                $result_set = mysqli_query($connect, $sql_select);

                // $list[$i]['num'] = $row['num'] ... $list[$i]['file_copied'] = $row['file_copied'] (X)
                // $list[0]['num'] ~ $list[0]['file_copied'] ... $list[1]['num'] ~ $list[1]['file_copied'] (O)
                
                $i = 0;
                while ($row = mysqli_fetch_array($result_set)) {
                    // set list number
                    $list[$i] = $row;
                    $list_num = $total_record - ($page - 1) * $scale;
                    $list[$i]['no'] = $list_num - $i;
                    $i++;
                }

                // set max width and height 
                $image_max_width = 250;
                $image_max_height = 250;

                for ($i = 0; $i < count($list); $i++) {
                    $file_image = (!empty($list[$i]['file_name'])) ? "<img src='http://{$_SERVER['HTTP_HOST']}/project/image/board_file.gif'>" : " ";
                    $date = substr($list[$i]['regist_day'], 0, 10);

                    // exist image file name
                    if (!empty($list[$i]['file_name'])) {
                        // $image_info : actual image size
                        $image_info = getimagesize($_SERVER['DOCUMENT_ROOT'] . "/project/data/" . $list[$i]['file_copied']);
                        $image_width = $image_info[0];
                        $image_height = $image_info[1];
                        $image_type = $image_info[2];

                        if ($image_width > $image_max_width)
                            $image_width = $image_max_width;

                        if ($image_height > $image_max_height)
                            $image_height = $image_max_height;

                        $file_copied = $list[$i]['file_copied'];
                    }
                    ?>

                <li>
                    <span>
                        <a href="image_board_view.php?num=<?= $list[$i]['num'] ?>&page=<?= $page ?>">
                            <?php
                                if (strpos($list[$i]['file_type'], "image") !== false)
                                    echo "<img src='http://{$_SERVER['HTTP_HOST']}/project/data/$file_copied' width='$image_width' height='$image_height'><br>";
                                else
                                    echo "<img src='http://{$_SERVER['HTTP_HOST']}/project/image/user.jpg' width='$image_max_width' height='$image_max_height'><br>";
                                ?>
                            <?= $list[$i]['subject'] ?>
                        </a>
                        <br>

                        <?= $list[$i]['id'] ?>
                        <br>

                        <?= $date ?>
                    </span>
                </li>
                <?php
                }
                mysqli_close($connect);
                ?>
            </ul>

            <ul id="page_num">
                <?php
                // get function : get_paging_opt
                include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/get_paging.php";

                $url = "http://{$_SERVER['HTTP_HOST']}/project/image_board/image_board_list.php";
                echo get_paging_opt2($total_page, $page, $url);
                ?>
            </ul>

            <ul class="buttons">
                <li>
                    <button onclick="location.href='image_board_list.php'">List</button>
                </li>

                <li>
                    <?php
                    if ($user_id) {
                        ?>
                    <button onclick="location.href='image_board_form.php'">Write</button>
                    <?php
                    } else {
                        ?>
                    <a href="javascript:alert('please login and use')">
                        <button>Write</button>
                    </a>
                    <?php
                    }
                    ?>
                </li>
            </ul>
        </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>