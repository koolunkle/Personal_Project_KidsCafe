<!-- php part -->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// set page
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set option
if (isset($_GET['option']))
    $option = $_GET['option'];
else
    $option = "question";

// set search string
if (isset($_GET['search_str']))
    $search_str = $_GET['search_str'];
else {
    $search_str = "";
    $flag = true;
}

$sql_select = "select count(*) as `total_count` from faq";

if ($option === "question")
    $sql_select .= " where $option like '%$search_str%'";
else
    $sql_select .= " where question LIKE '%$search_str%' or answer like '%$search_str%'";

$result_set = mysqli_query($connect, $sql_select);
$row = mysqli_fetch_array($result_set);
$total_record = intval($row[0]);

$scale = 3;

$total_page = ceil($total_record / $scale);

$start = ($page - 1) * $scale;

if ($option === "question")
    $sql_select = "select * from faq where $option like '%$search_str%' order by num limit {$start}, {$scale}";
else
    $sql_select = "select * from faq where question like '%$search_str%' or answer like '%$search_str%'";

$result_set = mysqli_query($connect, $sql_select);

// set array
$list = array();

$i = 0;
while ($row = mysqli_fetch_array($result_set)) {
    $list[$i] = $row;
    $list_num = $total_record - ($page - 1) * $scale;
    $list[$i]['num'] = $list_num - $i;
    $i++;
}
?>

<!-- html part -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/service_faq.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/service_faq.js"></script>
</head>

<body onload="set_question_answer()">
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/project/header.php"; ?>
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
            <h2>FAQ</h2>
            <hr>

            <div class="search">
                <form action="http://<?= $_SERVER['HTTP_HOST'] ?>/project/service/service_faq.php" method="get">
                    <select name="option" id="select">
                        <option value="question">질문</option>
                        <option value="answer">질문 및 답변</option>
                    </select>

                    <input type="text" id="search_str" name="search_str">
                    <input type="submit" value="Search" id="submit" onsubmit="return false">
                    <span id="error" style="color:red, font-size: 0.875rem;"></span>
                </form>
            </div>

            <div class="table">
                <table>
                    <tr>
                        <th id="type">구분</th>
                        <th id="content">내용</th>
                    </tr>

                    <?php
                    $sql_select = "select * from faq";
                    $result_set = mysqli_query($connect, $sql_select);

                    for ($i = 0; $i < count($list); $i++) { ?>
                    <tr>
                        <td>Q</td>
                        <td>
                            <a class="<?= $i ?>" href="#">
                                <?= $list[$i]['question']; ?>
                            </a>
                        </td>
                    </tr>

                    <tr class="A<?= $i ?>" style="display:none;">
                        <td>A</td>
                        <td>
                            <p class="<?= $i ?>" href="#">
                                <?= $list[$i]['answer']; ?>
                            </p>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <ul id="page_num">
                <?php
                // get function : get paging
                include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/get_paging.php";

                $url = "http://{$_SERVER['HTTP_HOST']}/project/service/service_faq.php";
                echo get_paging_opt2($total_page, $page, $url);
                ?>
            </ul>
        </main>
    </section>

    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php"; ?>
    </footer>
</body>

</html>