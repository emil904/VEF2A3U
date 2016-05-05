<?php 
	session_start();
	include('includes/title.php');
	include_once('includes/connection.php');
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
	<div class="row"> 
		
		<div class="large-8 columns"> 
			<div class="panel">
			<h2> Velkominn á þessa síðu </h2>
			<p> Bacon ipsum dolor amet pork shoulder capicola short ribs, landjaeger fatback chuck picanha. Leberkas pork loin short loin porchetta t-bone. Capicola short loin tri-tip hamburger doner tongue salami, andouille bresaola pork turkey chuck jowl pancetta. Alcatra boudin ham hock picanha tri-tip shoulder landjaeger frankfurter spare ribs brisket rump strip steak ground round.</p>
			<a class="button round" href="#">Fáðu að vita meira!</a>
			</div>
		</div>
		<div class="large-4 columns">
			<img src="img/bmw1.jpg">
		</div>
	</div>
	
	<hr />
	
	<div class="row">
		<div class="large-12 columns">
			<h3> Um hvað snýst þessi síða?</h3>
			<p> Bacon ipsum dolor amet pork shoulder capicola short ribs, landjaeger fatback chuck picanha. Leberkas pork loin short loin porchetta t-bone. Capicola short loin tri-tip hamburger doner tongue salami, andouille bresaola pork turkey chuck jowl pancetta. Alcatra boudin ham hock picanha tri-tip shoulder landjaeger frankfurter spare ribs brisket rump strip steak ground round.</p>
			
		</div>
		
		<div class="large-4 columns">
		</div>
	</div>
	
	<hr />
	
	<div class="row">
		<div class="large12-columns">
			
		</div>
	</div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
  <footer>
	<?php
		include('includes/footer.php');
	?>
  </footer>
</html>
