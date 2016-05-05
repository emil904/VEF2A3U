<?php
	$errors = [];
	$missing = [];
	if (isset($_POST['register'])){

 		$expected = ['firstName', 'lastName', 'email', 'username', 'password', 'MultipleChoiceQ', 'MultipleChoiceA'];
 		$required = ['firstName', 'email', 'username', 'password', 'MultipleChoiceQ', 'MultipleChoiceA'];
 		require './includes/processmail.php';
 		require_once './Users.php';

 		$firstName = trim($_POST['firstName']);
 		$lastname = trim($_POST['lastName']);
    	$email = trim($_POST['email']);
    	$username = trim($_POST['username']);
    	$password = trim($_POST['password']);
    	#$MCQ = trim($_POST['MultipleChoiceQ']);
    	#$MCA = trim($_POST['MultipleChoiceA']);

    	$dbUsers = new Users($conn);
    	$status = $dbUsers->newUser($firstName,$lastName,$email,$username,$password);

    	if ($status) {
    		$success = "$username has been registered. You may now log in.";
    	} else{
    		$errors[] = "$username is already in use. Please choose another username.";
    	}
		
	}