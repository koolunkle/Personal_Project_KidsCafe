<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/login.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/login_form.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- set login form -->
        <form name="login_form" method="post"
            action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/login/login_server.php">

            <h2>Login</h2>

            <!-- set message -->
            <?php
            if (isset($_GET['error']))
                echo "<p class='error'>{$_GET['error']}</p>";

            if (isset($_GET['success']))
                echo "<p class='success'>{$_GET['success']}</p>";
            ?>

            <!-- set id -->
            <label>id</label>
            <input type="text" name="id" placeholder="id">

            <!-- set password -->
            <label>password</label>
            <input type="password" name="password" placeholder="password">

            <!-- set button -->
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