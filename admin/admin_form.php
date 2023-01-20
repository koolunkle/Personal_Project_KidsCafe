<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/admin.css">
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <div id="admin_box">
            <h3>Administrator Mode > Manage User</h3>

            <ul id="member_list">
                <li>
                    <span class="col1">No.</span>
                    <span class="col2">ID</span>
                    <span class="col3">Name</span>
                    <span class="col4">Level</span>
                    <span class="col5">Point</span>
                    <span class="col6">Registration</span>
                    <span class="col7">Modify</span>
                    <span class="col8">Delete</span>
                </li>

                <?php
                // connect database
                include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

                $sql_select = "select * from members order by num desc";
                $result_set = mysqli_query($connect, $sql_select);
                $total_record = mysqli_num_rows($result_set);
                $number = $total_record;

                while ($row = mysqli_fetch_array($result_set)) {
                    $num = $row['num'];
                    $id = $row['id'];
                    $name = $row['name'];
                    $level = $row['level'];
                    $point = $row['point'];
                    $regist_day = $row['regist_day'];
                    $regist_day = substr($regist_day, 0, 10);
                    ?>

                <li>
                    <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/admin/admin_member_crud.php?mode=update"
                        method="post">
                        <input type="hidden" name="num" value="<?= $num ?>">

                        <span class=" col1">
                            <?= $number ?>
                        </span>

                        <span class="col2">
                            <?= $id ?>
                        </span>

                        <span class="col3">
                            <?= $name ?>
                        </span>

                        <span class="col4"><input type="text" name="level" value="<?= $level ?>"></span>
                        <span class="col5"><input type="text" name="point" value="<?= $point ?>"></span>

                        <span class="col6">
                            <?= $regist_day ?>
                        </span>

                        <span class="col7"><button type="submit">Modify</button></span>
                        <span class="col8"><button type="button"
                                onclick="location.href='admin_member_crud.php?mode=delete&num=<?= $num ?>'">Delete</button></span>
                    </form>
                </li>
                <?php
                    $number--;
                }
                ?>
            </ul>

            <h3>Administrator Mode > Manage Post</h3>

            <ul id="board_list">
                <li class="title">
                    <span class="col1">Select</span>
                    <span class="col2">No.</span>
                    <span class="col3">Name</span>
                    <span class="col4">Title</span>
                    <span class="col5">Attachment</span>
                    <span class="col6">Registration</span>
                </li>

                <form
                    action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/admin/admin_member_crud.php?mode=board_delete"
                    method="post">

                    <?php
                    $sql_select = "select * from image_post order by num desc";
                    $result_set = mysqli_query($connect, $sql_select);
                    $total_record = mysqli_num_rows($result_set);
                    $number = $total_record;

                    while ($row = mysqli_fetch_array($result_set)) {
                        $num = $row['num'];
                        $name = $row['name'];
                        $subject = $row['subject'];
                        $file_name = $row['file_name'];
                        $regist_day = $row['regist_day'];
                        $regist_day = substr($regist_day, 0, 10);
                        ?>

                    <li>
                        <span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>

                        <span class=" col2">
                            <?= $number ?>
                        </span>

                        <span class="col3"><?= $name ?></span>

                        <span class="col4">
                            <?= $subject ?>
                        </span>

                        <span class="col5"><?= $file_name ?></span>

                        <span class="col6">
                            <?= $regist_day ?>
                        </span>
                    </li>

                    <?php
                        $number--;
                    }
                    mysqli_close($connect);
                    ?>
                    <button type="submit">Delete</button>
                </form>
            </ul>
        </div>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>