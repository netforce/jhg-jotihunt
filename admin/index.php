<?php $page='index';
	require('pwdprotect.php');
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Admin - Jotihunt</title>
	<?php require('inc/headers.inc.php'); ?>
</head>
<body>
<div id="wrapper">

	<div id="top">
		<?php require('inc/top.inc.php'); ?>	
	</div><!--/#top-->


	<div id="main">
		<h2>Jotihunt Admin-pagina</h2>
		<p>Hier is het mogelijk om vrijwel alle informatie op de website aan te passen. Werkt er iets niet naar behoren op de website of op deze pagina, neem dan contact op met Ruud de Jong (06-10799136).</p>
	</div><!--/#main-->


	<div id="sidebar">
		<div id="nav">
			<?php require('inc/menu.inc.php'); ?>
		</div>
	</div><!--/#sidebar-->
	
	<div style="clear:both"></div>
	<div id="footer">
		<?php include('inc/footer.inc.php'); ?>	
	</div>

</div>
</body>
</html>