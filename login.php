<?php
	session_start(); 
	include('includes/title.php');
	require_once '/includes/connection.php';
	if(isset($_POST['login'])){
		require './includes/processlogin.php';
		$_SESSION['userlogin'] = $_POST['userlogin'];
		if(isset($_SESSION['userlogin'])){
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (30*60);
			header('Location:usercp.php');
		}
	}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VEF2A3U <?php echo "&#8212;{$title}"; ?></title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
	<header>
		<?php include('includes/header.php'); ?>
	</header>
		<div class="large-3 columns">	
			<h2>Sign in! </h2>
			<form method="post" action="">
				<p>
					<label for="userlogin">Username:</label>
					<input name="userlogin" id="userlogin" type="text">
				</p>
				<p>
					<label for="userpass">Password:</label>
					<input name="userpass" id="userpass" type="password">
				</p>
				<p>
					<input name="login" type="submit" value="Log in">
				</p>
			</form>
		</div>	
	</body>
</html>

