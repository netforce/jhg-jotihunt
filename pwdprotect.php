<?php

###############################################################
# Page Password Protect 2.13
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
############################################################### 
#
# Usage:
# Set usernames / passwords below between SETTINGS START and SETTINGS END.
# Open it in browser with "help" parameter to get the code
# to add to all files being protected. 
#    Example: password_protect.php?help
# Include protection string which it gave you into every file that needs to be protected
#
# Add following HTML code to your page where you want to have logout link
# <a href="http://www.example.com/path/to/protected/page.php?logout=1">Logout</a>
#
###############################################################

/*
-------------------------------------------------------------------
SAMPLE if you only want to request login and password on login form.
Each row represents different user.

$LOGIN_INFORMATION = array(
  'zubrag' => 'root',
  'test' => 'testpass',
  'admin' => 'passwd'
);

--------------------------------------------------------------------
SAMPLE if you only want to request only password on login form.
Note: only passwords are listed

$LOGIN_INFORMATION = array(
  'root',
  'testpass',
  'passwd'
);

--------------------------------------------------------------------
*/

##################################################################
#  SETTINGS START
##################################################################

// Add login/password pairs below, like described above
// NOTE: all rows except last must have comma "," at the end of line
$LOGIN_INFORMATION = array(
  'sjhhhwjh13'
);

// request login? true - show login and password boxes, false - password box only
define('USE_USERNAME', false);

// User will be redirected to this page after logout
define('LOGOUT_URL', 'http://jotihunt.scoutingjanhilgers.nl/');

// time out after NN minutes of inactivity. Set to 0 to not timeout
define('TIMEOUT_MINUTES', 0);

// This parameter is only useful when TIMEOUT_MINUTES is not zero
// true - timeout time from last activity, false - timeout time from login
define('TIMEOUT_CHECK_ACTIVITY', false);

##################################################################
#  SETTINGS END
##################################################################


///////////////////////////////////////////////////////
// do not change code below
///////////////////////////////////////////////////////

// show usage example
/*if(isset($_GET['help'])) {
  die('Include following code into every page you would like to protect, at the very beginning (first line):<br>&lt;?php include("' . str_replace('\\','\\\\',__FILE__) . '"); ?&gt;');
}*/

// timeout in seconds
$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);

// logout?
if(isset($_GET['logout'])) {
  setcookie("verify", '', $timeout, '/'); // clear password;
  header('Location: ' . LOGOUT_URL);
  exit();
}

if(!function_exists('showLoginPasswordProtect')) {

// show login form
function showLoginPasswordProtect($error_msg) {
	
	$totaalpunten = 0;
	$sql=mysql_query('SELECT * FROM hunts');
	while ($row_hunts=mysql_fetch_array($sql)){	
		$totaalpunten += $row_hunts['punten'];
	}
	$sql=mysql_query('SELECT * FROM tegenhunts');
	while ($row_tegenhunts=mysql_fetch_array($sql)){	
		$totaalpunten += $row_tegenhunts['punten'];
	}
	$page = (isset($_GET['p']))? $_GET['p'] : '';

?>

		<div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
			<form method="post">
				<h3>Geef het wachtwoord op om verder te gaan</h3>
				<font color="red"><?php echo $error_msg; ?></font><br />
				<?php if (USE_USERNAME) echo 'Gebruikersnaam:<br /><input type="input" name="access_login" /><br />Wachtwoord:<br />'; ?>
				<input type="password" name="access_password" id="wachtwoord_input"/><p></p><input type="submit" name="Submit" value="Gaan!" />
			</form>
		</div>
	</div><!--end #main-->
	<div id="sidebar">
		<div id="nav">
			<?php require('inc/menu.inc.php'); ?>
		</div>
	</div><!--/#sidebar-->
	
	<div style="clear:both"></div>
	<div id="footer">
		<?php include('inc/footer.inc.php'); ?>	
	</div>
</div><!--end #wrapper-->
<script type="text/javascript">
document.getElementById('wachtwoord_input').focus();
</script>
</body>
</html>

<?php
  // stop at this point
  die();
}
}

// user provided password
if (isset($_POST['access_password'])) {

  $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
  $pass = $_POST['access_password'];
  if (!USE_USERNAME && !in_array($pass, $LOGIN_INFORMATION)
  || (USE_USERNAME && ( !array_key_exists($login, $LOGIN_INFORMATION) || $LOGIN_INFORMATION[$login] != $pass ) ) 
  ) {
    showLoginPasswordProtect("Verkeerd wachtwoord.");
  }
  else {
    // set cookie if password was validated
    setcookie("verify", md5($login.'%'.$pass), $timeout, '/');
    
    // Some programs (like Form1 Bilder) check $_POST array to see if parameters passed
    // So need to clear password protector variables
    unset($_POST['access_login']);
    unset($_POST['access_password']);
    unset($_POST['Submit']);
  }

}

else {

  // check if password cookie is set
  if (!isset($_COOKIE['verify'])) {
    showLoginPasswordProtect("");
  }

  // check if cookie is good
  $found = false;
  foreach($LOGIN_INFORMATION as $key=>$val) {
    $lp = (USE_USERNAME ? $key : '') .'%'.$val;
    if ($_COOKIE['verify'] == md5($lp)) {
      $found = true;
      // prolong timeout
      if (TIMEOUT_CHECK_ACTIVITY) {
        setcookie("verify", md5($lp), $timeout, '/');
      }
      break;
    }
  }
  if (!$found) {
    showLoginPasswordProtect("");
  }

}

?>
