<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="login"; // Database name 
$tbl_name="users"; // Table name 

// Connect to server and select databse.
$db_handle = mysql_connect(‘173.194.238.74:3306’,
  ‘sample’, // username
  ''      // password
  );
$db_found = mysql_select_db(‘login’)or die(‘cannot select DB’);

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
//echo $count;
// $_SESSION["login"];
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
$_SESSION["myusername"]=$_POST['myusername']; ;
$_SESSION["mypassword"]=$_POST['mypassword'];

if($row['role']==2){
$_SESSION["login"]="admin"; 
header("location:admin.php");

}
else if ($row['role']==1){ 
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION["login"]="user";

header("location:user.php");
}

}
else {
header("location:index.php");
}
?>