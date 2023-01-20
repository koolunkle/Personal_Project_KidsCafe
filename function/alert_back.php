<?php
// set alert message
function alert_back($message)
{
  echo ("<script>alert('$message');history.back()</script>");
}
?>