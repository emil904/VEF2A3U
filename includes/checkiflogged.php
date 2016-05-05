<?php 
	if (isset($_SESSION['userlogin'])) {
		echo '<li><a href="logout.php"> Logout</a></li>';
	} else{
		echo '<li><a href="signup.php"> Sign Up</a></li>';
      	echo '<li><a href="login.php"> Log In</a></li>';
	}