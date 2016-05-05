<?php
	include ('lib/password.php');
	#Kóði til að checka hvort ehv linur séu tómar
	foreach ($_POST as $key => $value) {
		$temp = is_array($value) ? $value : trim($value);
		if (empty($temp) && in_array($key, $required)) {
			$missing[] = $key;
			${$key} = '';
		}elseif (in_array($key, $expected)) {
			${$key} = $temp;
		}
	}
	$e = $email;
	$sanitized_e = filter_var($e, FILTER_SANITIZE_EMAIL);
	if(filter_var($sanitized_e, FILTER_VALIDATE_EMAIL)){
		header("Location: http://tsuts.tskoli.is/2t/2310952929/verk2/usercp.php");
		die();
	} else{
		echo 'This email is invalid';
	}