<?php
use Uploads\File\Upload;
//maximum filesize in bytes
$max = 500*1024;
if (isset($_POST['upload'])) {
	//path to upload folder
	$destination = 'upload_test/';
	//moving file to upload folder and rename
	require_once '/Uploads/File/Upload.php';
	try {
		$loader = new Upload($destination);
		$loader->setMaxsize($max);
		$loader->upload();
		$loader->allowAllTypes(false);
		$result = $loader->getMessages();
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>
<!DOCTYPE HTML>
<?php //skilar $message breytunni úr loader() fallinu
	if (isset($result)){
		echo '<ul>';
		foreach ($result as $message) {
			echo "<li>$message</li>";
		}
	echo '</ul>';
	}
?>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
	<p>
		<label for="image">Upload image:</label>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?= $max; ?>">
		<input type="file" name="image[]" id="image" multiple>
	</p>
	<p>
		<input type="submit" name="upload" id="upload" value="Upload">
	</p>
</form>
