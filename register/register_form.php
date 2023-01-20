<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/register.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/js/register_form.js"></script>
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- register form -->
        <form action="http://<?= $_SERVER['HTTP_HOST']; ?>/project/register/register_server.php" method="post"
            name="register_form">
            <h2>Sign-Up</h2>

            <!-- message -->
            <?php
            if (isset($_GET['error']))
                echo "<p class='error'>{$_GET['error']}</p>";

            if (isset($_GET['success']))
                echo "<p class='success'>{$_GET['success']}</p>";
            ?>

            <!-- id -->
            <label>id</label>
            <div class="id">
                <input type="text" name="id" placeholder="id">
                <input class="input_duplicate" type="button" value="Duplicate" onclick="check_id()">
            </div>

            <!-- password -->
            <label>password</label>
            <input type="password" name="password" placeholder="password">

            <!-- password confirm -->
            <label>password confirm</label>
            <input type="password" name="password_confirm" placeholder="password confirm">

            <!-- name -->
            <label>name</label>
            <input type="text" name="name" placeholder="name">

            <!-- email -->
            <label>email</label>
            <input type="text" name="email" placeholder="email">

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