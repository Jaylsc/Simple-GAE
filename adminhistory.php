<?php 

// include db config 
include_once("config.php"); 

// set up DB 
mysql_connect(':/cloudsql/poised-shuttle-119914:trial','root','');
mysql_select_db('griddemo') or die("cannot select DB");; 

$sql ="CREATE TABLE `task1` (
  `Taskname` char(255) NOT NULL DEFAULT 'task1',
  `ID` int(11) NOT NULL,
  `Name` char(120) DEFAULT NULL,
  `Points` int(255) DEFAULT '0',
  `Status` varchar(25) NOT NULL DEFAULT 'Incomplete'
) ENGINE=MyISAM DEFAULT CHARSET=utf8";

if (mysqli_query($conn, $sql)) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// include and create object 
include(PHPGRID_LIBPATH."inc/jqgrid_dist.php"); 
session_start();

// preserve selection for ajax call 
if (!empty($_POST["tables"])) 
{ 
    $_SESSION["tab"] = $_POST["tables"]; 
    
    $tab = $_SESSION["tab"]; 
} 

// update on ajax call 
if (!empty($_GET["grid_id"])) 
    $tab = $_SESSION["tab"]; 

if (!empty($tab)) 
{ 
   
    
    $g = new jqgrid(); 

    // set few params 
    $grid["caption"] = "Admin - $tab"; 
    $grid["autowidth"] = true; 
    $grid["autoresize"] = true; 
    //$grid["multiselect"] = true; // allow you to multi-select through checkboxes 
    $grid["reloadedit"] = true;         
    
$g->set_options($grid); 

    // set database table for CRUD operations 
    $g->table = $tab; 

    // render grid 
    $out = $g->render("list1");
    
} 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
<head> 
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/redmond/jquery-ui.custom.css"></link>     
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>     
     
    <script src="lib/js/jquery.min.js" type="text/javascript"></script> 
    <script src="lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script> 
    <script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
    <script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
</head> 
<body> 
    <style>* {font-family: "Open Sans", tahoma;}</style> 
    <form method="post"> 
        <fieldset> 
        <legend>Database Tables</legend> 
        <strong>After selecting the task , press load table </strong>
        Select: <select name="tables"> 
        <?php 
            $q = mysql_query('SHOW TABLES'); 
            echo $q;
            while($rs = mysql_fetch_array($q)) 
            {  
                $sel = (($rs[0] == $_POST["tables"])?"selected":""); 
            ?> 
                <option <?php echo $sel?>><?php echo $rs[0]?></option> 
            <?php 
            } 
        ?> 
        </select> 
        <input type="submit" value="Load Table"> 
        </fieldset> 
    </form> 
    <?php      
    
if (!empty($out)) { ?> 
    
    
    <br> 
    <fieldset> 
        
        <?php 
include 'database.php';
$query="SELECT * FROM $tab";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    
    if($row['Points']!=0){
    //echo $row['Points'];
    $ID=$row['ID'];
    $change = mysql_query(" UPDATE $tab SET Status = 'complete' WHERE ID=$ID ");
    if($change){
    //echo "Success!";
    }
}
} 
 echo $out?> 
    </fieldset>     
    <?php } ?> 
       <button onclick="myFunction()">Copy Text</button>  
</body> 
</html> 