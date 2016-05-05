<?php
include('./Users.php');
$source = 'mysql:host=tsuts.tskoli.is;dbname=2310952929_skil5';
$user = '2310952929';
$pass = 'Emmi2310952929';
try {
	$conn = new PDO($source, $user, $pass);
	$conn->exec('SET NAMES "utf8"');
} catch (PDOException $e) {
	echo 'Tenging mistókst: ' . $e->getMessage();
}
