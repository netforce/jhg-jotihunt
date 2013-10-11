<?php

$host="";
$dbusername="";
$dbpassword="";
$dbname="";

//connect
mysql_connect($host,$dbusername,$dbpassword) or die('Could not connect to server.');

//select
mysql_select_db($dbname) or die('Could not select database.');


?>
