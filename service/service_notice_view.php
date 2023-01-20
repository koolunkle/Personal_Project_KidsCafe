<!-- php part -->
<?php
// connect database
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

$mode = $_GET['mode'];
$title = isset($_GET['title']) ? $_GET['title'] : "";
$content = "";

if ($mode === "read") {
    $num = isset($_GET['num']) ? $_GET['num'] : "";

    $sql_select = "select * from notice where num = '$num'";
    $update_query = "update notice set read_count = read_count+1 where num = $num";

    $view_query = mysqli_query($connect, $update_query);
    $result_set = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_array($result_set);

    $title = $row['title'];
    $content = $row['content'];
    $written_date = $row['written_date'];
} elseif ($mode === "write")
    $written_date = date('Y-m-d H:i:s', time());
?>

<!-- html part -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css"
        href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/service_notice_view.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/service_notice_view.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- set aside -->
        <aside>
            <h3>Service Center</h3>

            <ul>
                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/service/service_notice.php">
                        Notice
                    </a>
                </li>

                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/service/service_faq.php">
                        FAQ
                    </a>
                </li>
            </ul>
        </aside>

        <main>
            <h2>Notice</h2>
            <hr>

            <!-- set form -->
            <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/service/service_notice_crud.php" method="post">
                <table>
                    <input type="hidden" value="<?= $num ?>" name="num">

                    <tr>
                        <!-- print error message -->
                        <?php if (isset($_GET['error'])) { ?>
                        <div id="check" style="color: red"><?= $_GET['error'] ?></div>
                        <?php } ?>

                        <!-- if admin -->
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === "admin") { ?>
                        <!-- set title -->
                        <td class=" title"><b>Title</b></td>
                        <td><input type="text" id="title" name="title" value="<?= $title ?>" required></td>
                    </tr>

                    <!-- set registration -->
                    <tr>
                        <td class="title"><b>Registration</b></td>
                        <td>
                            <input type="text" id="current_date" name="written_date" value="<?= $written_date ?>"
                                readonly>
                        </td>
                    </tr>

                    <!-- set content -->
                    <tr>
                        <td class="title"><b>Content</b></td>
                        <td>
                            <textarea name="content" id="content" cols="30" rows="10"><?= $content ?></textarea>
                        </td>
                    </tr>

                    <!-- if not admin -->
                    <?php } else { ?>
                    <!-- set title -->
                    <tr>
                        <td class="title"><b>Title</b></td>
                        <td>
                            <input type="text" name="title" value="<?= $title ?>" readonly>
                        </td>
                    </tr>

                    <!-- set registration -->
                    <tr>
                        <td class="title"><b>Registration</b></td>
                        <td>
                            <input type="text" id="current_date" name="written_date" value="<?= $written_date ?>"
                                readonly>
                        </td>
                    </tr>

                    <!-- set content -->
                    <tr>
                        <td class="title" id="content"><b>Content</b></td>
                        <td>
                            <textarea name="content" cols="30" rows="10" readonly><?= $content ?></textarea>
                        </td>
                    </tr>
                    <?php } ?>
                </table>

                <div class="button">
                    <!-- if admin -->
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === "admin") { ?>

                    <!-- if mode is write -->
                    <?php if ($mode === "write") { ?>
                    <input type="submit" class="submit" value="Write" name="mode">

                    <!-- if mode is read -->
                    <?php } elseif ($mode === "read") { ?>
                    <input type="submit" class="submit" value="Modify" name="mode">
                    <input type="submit" value="Delete" name="mode">
                    <?php } ?>
                    <?php } ?>
                </div>
            </form>
        </main>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>