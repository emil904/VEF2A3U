<?php include('includes/title.php'); 
include('includes/random_image.php');?>
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
		<?php include('includes/header.php'); ?>
		<figure>
			<img src="<?php echo($selectedImage); ?>" alt="Random image">
			<figcaption><?php echo "$randomCaption" ?></figcaption>
		</figure>
	</header>
   </body>
</html>