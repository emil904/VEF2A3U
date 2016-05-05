<?php
	$images = ['img/bmw1.jpg', 'img/bmw2.jpg', 'img/bmw3.jpg'];
	$i = rand(0, count($images)-1);
	$selectedImage = $images[$i];
	if ($i == 0) {
		$randomCaption = 'Bmw1';
	}
	elseif ($i == 1) {
		$randomCaption = 'Bmw2';
	}
	elseif ($i == 2) {
		$randomCaption = 'Bmw3';
	}
?>
