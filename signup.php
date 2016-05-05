<?php
	session_start(); 
	include('includes/title.php');
	require_once('includes/processRegister.php');
	require_once('Users.php');
	
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
		<?php include('includes/header.php'); ?>
	</header>
	<div class="large-3 columns">
		<h2>Sign Up!</h2>
		<?php if ($missing || $errors) { ?>
			<span class="[success alert secondary] label"> Please fix the item(s) indicated. </span>
		<?php } ?>
		<p>Bacon ipsum dolor amet sirloin alcatra cow ground round corned beef fatback. Porchetta doner ground round shank sirloin. Strip steak boudin sirloin ribeye pork belly turducken kevin fatback drumstick spare ribs.</p>
		<form method="post" action="">
			<p>
				<label for="firstName">First Name:
					<?php if($missing && in_array('firstName', $missing)) { ?>
						<span class="[success alert secondary] label">Please enter your first name.</span>
					<?php } ?>
				</label>
				<input name="firstName" id="firstName" type="text"
				<?php if($missing || $errors) {
					echo 'value="' . htmlentities($firstName) . '"';
				} ?>>
			</p>
			<p>
				<label for="lastName">Last Name:</label>
				<input name="lastName" id="lastName" type="text"
				<?php if($missing || $errors) {
					echo 'value="' . htmlentities($lastName) . '"';
				} ?>>
			</p>
			<p>
				<label for="email">Email:
					<?php if($missing && in_array('email', $missing)) { ?>
						<span class="[success alert secondary] label">Please enter an email address.</span>
					<?php } ?>
				</label>
				<input name="email" id="email" type="text"
				<?php if($missing || $errors) {
					echo 'value="' . htmlentities($email) . '"';
				} ?>>
			</p>
			<p>
				<label for="username">Username:
				<?php if($missing && in_array('username', $missing)) { ?>
					<span class="[success alert secondary] label">Please enter an username.</span>
				<?php } ?></label>
				<input name="username" id="username" type="text"
				<?php if($missing || $errors) {
					echo 'value="' . htmlentities($username) . '"';
				} ?>>
			</p>
			<p>
				<label for="password">Password:
					<?php if($missing && in_array('password', $missing)) { ?>
						<span class="[success alert secondary] label">Please enter a password.</span>
					<?php } ?>
				</label>
				<input name="password" id="password" type="text">
			</p>

			<p>
				<label for="MultipleChoice">Please choose a question:</label>
				<select name="MultipleChoiceQ" id="MultipleChoiceQ">
						<option value="None chosen"
						<?php
							if (!$_POST || $_POST['MultipleChoiceQ'] == "None chosen") {
								echo 'selected';
							} 
						?>> Select one
						</option>
						<option value="What is the first name of the person you first kissed?"
						<?php
							if (!$_POST || $_POST['MultipleChoiceQ'] == "What is the first name of the person you first kissed?") {
								echo 'selected';
							} ?>>What is the first name of the person you first kissed?
						</option>
						<option value="What was the name of your elementary school?"
						<?php
							if (!$_POST || $_POST['MultipleChoiceQ'] == "What was the name of your elementary school?") {
								echo 'selected';
							} ?>> What was the name of your elementary school?
						</option>
				</select>
			</p>

			<p>
				<label for="MultipleChoiceA">Answer:
					<?php if($missing && in_array('MultipleChoiceA', $missing)) { ?>
						<span class="[success alert secondary] label">Please enter an answer</span>
					<?php } ?>
				</label>
				<input name="MultipleChoiceA" id="MultipleChoicA" type="text">
			</p>

			<p>
				<input name="register" type="submit" value="Sign Up">
			</p>
		</form>
	</div>
  </body>
</html>