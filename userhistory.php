<?php
include_once("config.php");

// set up DB
mysql_connect(PHPGRID_DBHOST, PHPGRID_DBUSER, PHPGRID_DBPASS);
mysql_select_db(PHPGRID_DBNAME);

// include and create object
include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");
$g = new jqgrid();

// set few params
$grid["caption"] = "User";
$g->set_options($grid);

$g->set_actions(array( 
                        "add"=>false,
                        "delete"=>false, 
                        "edit"=>false,
                        "search" => "simple",
                       
                    ) 
                );

include 'database.php'; 

$e=$_SESSION["myusername"];
$sql = "SHOW TABLES";
$res = mysql_query($sql);
$num = mysql_num_rows($res); 
$count=1;
$query="SELECT * FROM task1";
while($count<$num){
$count++;    $string="task$count";
$query="$query UNION (SELECT * FROM $string)  ";

}

$query2=" SELECT Taskname , Name , Points, Status FROM ($query) AS U WHERE U.Name='$e' ";
$g->select_command = $query2;


// set database table for CRUD operations
//$g->table = "task1";


// render grid
$out = $g->render("list1");

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
	<div style="margin:10px">
	
        <?php     
        echo $out?>
	</div>
</body>
</html>
