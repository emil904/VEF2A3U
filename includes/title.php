<?php
$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
if ($title == 'index') {
	$title = 'home';
}
$title = ucfirst($title);