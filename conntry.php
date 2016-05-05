<?php
	include_once('includes/class.datamanager.php');
	$db_man = new DatabaseManager('82.148.66.15','2310952929_picturebase', '2310952929', 'Emmi2310952929'); 
?>
<!doctype html>
<html>
	<?php 
		$sql = 'SELECT * FROM users';
		$result = $db_man->query($sql);
		if (!$result) {
			$error = $db_man->error;
		} else{
			echo "<p> A total of $numRows records were found.</p>";	
		}
	?>
</html>