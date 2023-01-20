<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/register.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/register_modify_form.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <!-- connect database -->
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";

    $sql_select = "select * from members where id = '$user_id'";
    $result_set = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_array($result_set);

    $user_password = $row['pass'];
    $user_name = $row['name'];
    $user_email = $row['email'];

    mysqli_close($connect);
    ?>

    <section>
        <!-- modify form -->
        <form name="register_modify_form" method="post"
            action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/register/register_modify_server.php?id=<?= $user_id ?>">
            <h2>Modify User Info</h2>

            <!-- message -->
            <?php
            if (isset($_GET['error']))
                echo "<p class='error'>{$_GET['error']}</p>";

            if (isset($_GET['success']))
                echo "<p class='success'>{$_GET['success']}</p>";
            ?>

            <!-- id -->
            <label>id</label>
            <input type="text" name="id" value="<?= $user_id ?>" readonly>

            <!-- password -->
            <label>password</label>
            <input type="password" name="password" placeholder="password">

            <!-- password confirm -->
            <label>password confirm</label>
            <input type="password" name="password_confirm" placeholder="password confirm">

            <!-- name -->
            <label>name</label>
            <input type="text" name="name" placeholder="name" value="<?= $user_name ?>">

            <!-- email -->
            <label>email</label>
            <input type="text" name="email" placeholder="email" value="<?= $user_email ?>">

            <!-- button -->
            <div class="input_button">
                <input class="btn" type="submit" value="Submit">
                <input class="btn" type="button" value="Reset" onclick="reset_form()">
            </div>
        </form>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>