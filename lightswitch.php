<?php
if(isset($_GET['switch'])){
	if(isset($_COOKIE['css'])){
		$currentCookie = $_COOKIE['css'];
		switch($currentCookie){
			case 'night':
				$value='day';
			break;
			case 'day':
				$value='night';
			break;
			case '':
			default:
				$value='day';
			break;
		}
	}else{
		$value = 'day';
	}
	setcookie("css", $value, time()+600000);
	header("Location: ".$_SERVER['HTTP_REFERER']);
}else{
	if(isset($_COOKIE['css'])){
		$currentCookie = $_COOKIE['css'];
		switch($currentCookie){
			case 'night':
				$value='night';
			break;
			case 'day':
				$value='day';
			break;
			case '':
			default:
				$value='day';
			break;
		}
	}else{
		setcookie("css", 'day', time()+600000);
		$value = 'day';
	}	
}
?>
<link rel="stylesheet" type="text/css" href="css/<?=$value;?>.css" />