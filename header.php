<?php
// start session 
session_start();

// declare global variable
$user_id = $user_name = $user_level = $user_point = null;

// secure coding
if (isset($_SESSION['user_id']))
  $user_id = $_SESSION['user_id'];
if (isset($_SESSION['user_name']))
  $user_name = $_SESSION['user_name'];
if (isset($_SESSION['user_level']))
  $user_level = $_SESSION['user_level'];
if (isset($_SESSION['user_point']))
  $user_point = $_SESSION['user_point'];
?>

<div id="top">
    <!-- set logo -->
    <div id="top_logo">
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/logo.png" alt="logo">
    </div>

    <!-- set title -->
    <h3><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/main.php">The Mirae Kids Cafe</a></h3>

    <!-- set top menu list -->
    <ul id="top_menu">
        <!-- if user not logged -->
        <?php if (!$user_id) { ?>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/register/register_form.php">Sign-Up</a></li>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/login/login_form.php">Login</a></li>
        <!-- if user logged -->
        <?php } else { ?>

        <li>
            <!-- <?= $user_name . "(" . $user_id . ")님[Level:" . $user_level . ", Point:" . $user_point . "]" ?> -->
            <?= $user_name . "(Point:" . $user_point . ")" ?>
        </li>

        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/register/register_modify_form.php">Modify</a></li>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/membership/membership_delete.php">Delete</a></li>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/login/login_logout.php">Logout</a></li>
        <?php } ?>

        <!-- admin mode -->
        <?php if ($user_level == 1) { ?>
        <li> | </li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/admin/admin_form.php">Admin</a></li>
        <?php } ?>
    </ul>
</div>

<!-- set menu bar -->
<div id="menu_bar">
    <ul>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/about/about_us.php">About Us</a></li>

        <li>
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/amusement/amusement_mystery_house.php">Amusement</a>
        </li>

        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/restaurant/restaurant_korean.php">Restaurant</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/message/message_form.php">Message</a></li>
        <li><a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image_board/image_board_form.php">Image Board</a></li>

        <li>
            <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/service/service_notice.php">Service Center</a>
        </li>
    </ul>
</div>