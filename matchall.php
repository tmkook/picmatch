<?php

include 'picmatch.php';
$images = glob('images/*.jpg');
$count = count($images)-1;

foreach($images as $img){
	$file = $images[mt_rand(0,$count)];
	$file2 = $images[mt_rand(0,$count)];
	$color1 = getColor($file);
	$color2 = getColor($file2);
	$colornum = match($color1,$color2);
	echo '<img src="'.$file.'" />';
	echo '<img src="'.$file2.'" /><br>相似度：';
	echo $colornum;
	echo '<br><hr>';
}
