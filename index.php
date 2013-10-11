<?php
	include('connect.php');
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Jotihunt</title>
	<?php require('inc/head.inc.php'); ?>
</head>
<body>
<div id="wrapper" style="position: relative;">
	<a href="lightswitch.php?switch">
		<div id="lightswitch">
			<div></div>
		</div>
	</a>

	<div id="top">
		<?php require('inc/top.inc.php'); ?>	
	</div><!--/#top-->


	<div id="main">
		<?php
		//Wachtwoord
		require('pwdprotect.php');

		//In plaats van dynamisch includen is dit veiliger. Het enige 'nadeel' is dat toegestane pagina's handmatig moeten worden toegevoegd.
		$page = (isset($_GET['p']))? $_GET['p'] : '';
		switch ($page){
			case 'hunts':
				echo"<h2>Hunts</h2>";
				include('inc/content/hunts.php');
				break;
			case 'hints':
				echo"<h2>Hints</h2>";
				include('inc/content/hints.php');
				break;
			case 'opdrachten':
				echo"<h2>Opdrachten</h2>";
				include('inc/content/opdrachten.php');
				break;
			case 'fotoopdrachten':
				echo"<h2>Foto-opdrachten</h2>";
				include('inc/content/fotoopdrachten.php');
				break;
			case 'vossen':
				echo"<h2>Vossen</h2>";
				include('inc/content/vossen.php');
				break;
			case 'autoritten':
				echo"<h2>Autoritten</h2>";
				include('inc/content/autoritten.php');
				break;
			case 'tijdschema':
				echo"<h2>Tijdschema</h2>";
				include('inc/content/tijdschema.php');
				break;
			case 'telefoonlijst':
				echo"<h2>Telefoonlijst</h2>";
				include('inc/content/telefoonlijst.php');
				break;
			case 'links':
				echo"<h2>Links</h2>";
				include('inc/content/links.php');
				break;

			case 'home':
			case '':
				echo"<h2>Jotihunt 2013</h2>";
				include('inc/content/home.php');
				break;

			default:
				include('404.html');
				break;
		}
		?>
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