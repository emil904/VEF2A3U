<?php
  session_start();
  if (!isset($_SESSION['userlogin'])) {
    header('Location:login.php');
  } else {
    $now = time();
    if ($now > $_SESSION['expire']) {
      session_destroy();
      header('Location:login.php');
    }
  }
	include('includes/title.php');
	include_once('includes/connection.php');
  if (array_key_exists('delete_file', $_POST)) {
    $filename = $_POST['delete_file'];
    if (file_exists($filename)) {
      unlink($filename);
      echo 'File '.$filename.' has been deleted';
    } else {
      echo 'Could not delete '.$filename.', file does not exist';
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
		<?php
			include('includes/header.php');
		?>
	</header>
  <body>
    <div>
        <div class="centerdiv">
          <?php echo"<h1> Welcome " . $_SESSION['userlogin'] .  "!</h1> "; ?>
        </div>
    </div>
  <div class="large-3 columns" style="border: 10px solid #466d98;">
    <?php include('Uploads/upload.php'); ?>
  </div>
  <div class="large-6 columns">
    <?php
      echo '<form method="post">';
      $images = glob("upload_test/*.{jpg,gif,png}", GLOB_BRACE);
      echo '<ul class="medium-block-grid-3">';
      foreach ($images as $image){ #prentar út myndirnar
        echo '<li><img src="upload_test/' . basename($image) . '"> ';
        echo '<form method="post">';
        echo '<input type="hidden" value="'.$image.'" name="delete_file" />';
        echo '<input type="submit" value="Delete image" />';
        echo '</form>';
        echo '</li>';
      };
      echo '</ul>'; 
    ?>
  </div>
  <div class="large-3 columns">
  </div>
  </body>

  <footer>
      <?php
        include('includes/footer.php');
      ?>
  </footer>
</html>
