<?php
require('pwdprotect.php');

function logUpdate($page){
	$query ="INSERT INTO updated SET pagina='".$page."'";
	$result = mysql_query($query);
	if(!$result)
	{
		echo "Error while saving: [".mysql_error()."]";
	}
}
?>