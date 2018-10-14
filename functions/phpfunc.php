<?php
$servername = "mysli.oamk.fi";
$username = "c7paja00";
$password = "9Y5gXKWm8XBG7ok9";
$dbname = "opisk_c7paja00";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
