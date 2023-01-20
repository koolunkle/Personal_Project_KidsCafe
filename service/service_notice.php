<!-- php part -->
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

// set page
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set search
$search = (isset($_GET['search'])) ? $_GET['search'] : "title";

// 전체 게시글 수 구하기
if (!isset($_GET['search'])) {
  $sql_select = "select count(*) as `total_count` from notice";
} else {
  // search title
  if ($search === "title") {
    $name_id = $_GET['name_id'];
    $sql_select = "select count(*) as `total_count` from notice where title = '$name_id'";
  } else {
    // search content
    $name_id = $_GET['name_id'];
    $sql_select = "select count(*) as `total_count` from notice where content = '$name_id'";
  }
}

$result_set = mysqli_query($connect, $sql_select);
$row = mysqli_fetch_array($result_set);
$total_record = intval($row[0]);

// 한 페이지에 들어갈 게시글 수 정하기
$scale = 3;

// 전체 페이지 수 구하기
$total_page = ceil($total_record / $scale);

// 해당 페이지의 몇번째 글부터 띄울 것인지 정하기
$start = ($page - 1) * $scale;

// 해당되는 페이지 레코드 가져오기
if (!isset($_GET['search']))
  $sql_select = "select * from notice order by num desc limit $start, $scale";
else {
  if ($search === "title") {
    $name_id = $_GET['name_id'];
    $sql_select = "select * from notice where title like '%{$name_id}%' order by num desc limit $start, $scale";
  } elseif ($search === "content") {
    $name_id = $_GET['name_id'];
    $sql_select = "select * from notice where content like '%{$name_id}%' order by num desc limit $start, $scale";
  }
}

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
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/service_notice.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/service_notice.js"></script>
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

        <!-- set main -->
        <main>
            <h2>Notice</h2>
            <hr>

            <!-- set search -->
            <div class="search">
                <select id="root">
                    <option value="title" <?=($search === "title" ? "selected" : "") ?>>Title</option>
                    <option value="content" <?=($search === "content" ? "selected" : "") ?>>Content</option>
                </select>

                <input type="text" id="name_id">
                <input type="submit" id="search" value="Search">
            </div>

            <?php
      $result_set = mysqli_query($connect, $sql_select);

      for ($i = 0; $row = mysqli_fetch_array($result_set); $i++) {
        $list[$i] = $row;
        $written_date[$i] = $list[$i]['written_date'];
      }
      ?>

            <!-- set table -->
            <div class="table">
                <table>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Registration</th>
                    <th>Hits</th>

                    <?php
          if (isset($list)) {
            if (count($list) === 0) {
              echo "<tr>";
              echo "<td colspan='5'>등록된 내용이 없습니다</td>";
              echo "</tr>";
            }

            for ($i = 0; $i < count($list); $i++) {
              echo "<tr>";
              $num = $list[$i]['num'];
              echo "<td>{$list[$i]['num']}</td>";
              echo "<td><a href='service_notice_view.php?mode=read&title=" . $list[$i]['title'] . "&num=$num'>{$list[$i]['title']}</a></td>";
              echo "<td>관리자</td>";
              echo "<td>{$written_date[$i]}</td>";
              echo "<td>{$list[$i]['read_count']}</td>";
              echo "</tr>";
            }
          }
          ?>
                </table>
            </div>

            <!-- set paging -->
            <ul id="page_num">
                <?php
        // get function : get paging
        include_once $_SERVER['DOCUMENT_ROOT'] . "/project/function/get_paging.php";

        $url = "http://{$_SERVER['HTTP_HOST']}/project/service/service_notice.php";
        echo get_paging_opt2($total_page, $page, $url);
        ?>
            </ul>

            <!-- set button -->
            <div class="button">
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === "admin") { ?>
                <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/service/service_notice_view.php?mode=write"><input
                        type="button" value="Write"></a>
                <?php } ?>
            </div>
        </main>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>