<?php 

	#include ('lib/password.php');
	#Kóði til að checka hvort ehv linur séu tómar
	foreach ($_POST as $key => $value) {
		$temp =  trim($value);
		if (empty($temp)){
			${$key} = '';
		}else{
			${$key} = $temp;
		}
		
	}
	if (!empty($userlogin) && !empty($userpass)){	
		$validate = $dbh->validateUser($userlogin,$userpass);
		if ($validate) {
			$redirect = 'http://tsuts.tskoli.is/2t/2310952929/verk2/usercp.php';
			header("Location: $redirect");
		} else{
			echo 'Vitlaust notendanafn eða lykilorð';
		}
	} else{
		echo 'Vantar notendanafn eða lykilorð';
	}