<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="griddemo"; // Database name 

$db_handle= mysql_connect('173.194.238.74:3306’,
  ‘sample’, // username
  ''      // password
  );
$db_found = mysql_select_db(“login”)or die("cannot select DB");



?>

