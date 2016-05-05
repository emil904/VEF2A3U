<?php
//maximum filesize in bytes
$max = 51200;
if (isset($_POST['upload'])) {
	//path to upload folder
	$destination = '../upload_test/';
	//moving file to upload folder and rename
	move_uploaded_file($_FILES['image']['tmp_name'], $destination . $_FILES['image']['name']);
}
?>
<!DOCTYPE HTML>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
	<p>
		<label for="image">Upload image:</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $max; ?>">
		<input type="file" name="image" id="image">
	</p>
	<p>
		<input type="submit" name="upload" id="upload" value="Upload">
	</p>
</form>
