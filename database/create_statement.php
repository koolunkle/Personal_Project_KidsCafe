<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_database.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/database/create_table.php";

// Table
create_table($connect, "members");
create_table($connect, "message");
create_table($connect, "post");
create_table($connect, "post_reply");
create_table($connect, "image_post");
create_table($connect, "image_post_reply");
create_table($connect, "notice");
create_table($connect, "faq");

// Function

// Index

// Procedure

// Trigger
?>