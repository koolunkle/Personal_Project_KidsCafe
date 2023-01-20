<?php
function create_table($connect, $table_name)
{
  // check table 
  $database_flag = false;
  $sql = "show tables from practice";
  $result = mysqli_query($connect, $sql) or die("table show fail" . mysqli_error($connect));

  while ($row = mysqli_fetch_array($result)) {
    // key : Tables_int_practice or index 0
    if ($row["Tables_in_practice"] == "$table_name") {
      $database_flag = true;
      break;
    }
  }

  // if table does not exist
  if ($database_flag == false) {
    switch ($table_name) {
      // members table
      case 'members':
        $sql = "
        CREATE TABLE IF NOT EXISTS `members` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `pass` varchar(255) NOT NULL,
          `name` char(10) NOT NULL,
          `email` char(80) DEFAULT NULL,
          `regist_day` char(20) DEFAULT NULL,
          `level` int(11) DEFAULT NULL,
          `point` int(11) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        break;

      // message table
      case 'message':
        $sql = "
          CREATE TABLE IF NOT EXISTS `message` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `send_id` char(20) NOT NULL,
            `rv_id` char(20) NOT NULL,
            `subject` char(200) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) DEFAULT NULL,
            PRIMARY KEY (`num`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          ";
        break;

      // post table
      case 'post':
        $sql = "
        CREATE TABLE IF NOT EXISTS `post` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `id` char(15) NOT NULL,
          `name` char(10) NOT NULL,
          `subject` char(200) NOT NULL,
          `content` text NOT NULL,
          `regist_day` char(20) NOT NULL,
          `hit` int(11) NOT NULL,
          `file_name` char(40) DEFAULT NULL,
          `file_type` char(40) DEFAULT NULL,
          `file_copied` char(40) DEFAULT NULL,
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        break;

      // post reply table
      case 'post_reply':
        $sql = "
          CREATE TABLE IF NOT EXISTS `post_reply` (
              `num` int(11) NOT NULL AUTO_INCREMENT,
              `parent` int(11) NOT NULL,
              `id` char(15) NOT NULL,
              `name` char(10) NOT NULL,
              `nick` char(10) NOT NULL,
              `content` text NOT NULL,
              `regist_day` char(20) DEFAULT NULL,
              PRIMARY KEY (`num`),
              KEY `regist_day` (`regist_day`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ";
        break;

      // image post table
      case 'image_post':
        $sql = "
        CREATE TABLE IF NOT EXISTS `image_post` (
            `num` int NOT NULL AUTO_INCREMENT,
            `id` char(15) NOT NULL,
            `name` char(10) NOT NULL,
            `subject` char(200) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) NOT NULL,
            `hit` int NOT NULL, 
            `file_name` char(40) NOT NULL,
            `file_type` char(40) NOT NULL,
            `file_copied` char(40) NOT NULL,
            PRIMARY KEY (`num`),
            KEY `id` (`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ";
        break;

      // image post reply
      case 'image_post_reply':
        $sql = "
        CREATE TABLE IF NOT EXISTS `image_post_reply` (
            `num` int(11) NOT NULL AUTO_INCREMENT,
            `parent` int(11) NOT NULL,
            `id` char(15) NOT NULL,
            `name` char(10) NOT NULL,
            `nick` char(10) NOT NULL,
            `content` text NOT NULL,
            `regist_day` char(20) DEFAULT NULL,
            PRIMARY KEY (`num`),
            KEY `regist_day` (`regist_day`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ";
        break;

      // notice table
      case 'notice':
        $sql = "
        CREATE TABLE IF NOT EXISTS `notice` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `title` varchar(255) NOT NULL DEFAULT '',
          `content` varchar(255) NOT NULL DEFAULT '',
          `written_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          `read_count` int(11) NOT NULL DEFAULT '0',
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          ";
        break;

      // faq table
      case 'faq':
        $sql = "
        CREATE TABLE IF NOT EXISTS `faq` (
          `num` int(11) NOT NULL AUTO_INCREMENT,
          `question` varchar(255) NOT NULL DEFAULT '',
          `answer` varchar(255) NOT NULL DEFAULT '',
          PRIMARY KEY (`num`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          ";
        break;

      default:
        echo "<script>alert('no such table found')</script>";
        break;
    }

    $result = mysqli_query($connect, $sql) or die("database connect fail" . mysqli_error($connect));
    if ($result == true)
      echo "<script>alert('{$table_name} table has been created')</script>";
    else
      echo "<script>alert('{$table_name} table has not been created')</script>";
  }
}
?>