<?php

include 'picmatch.php';
$pic = 'match.jpg';
$images = glob('images/*.jpg');
$matchs = array();

foreach($images as $img){
    $color1 = getColor($pic);
    $color2 = getColor($img);
    $matchs[floor(match($color1,$color2))] = $img;
}

krsort($matchs);

echo '<img src="'.$pic.'" /><br>最相似的图片是：<hr>';

foreach($matchs as $img){
    echo '<img src="'.$img.'" />';
}