<?php
function getColor($file,$gray=0,$contrast=0){
	$canvas_w = 16;
	$canvas_h = 16;
	$ims = imagecreatefromjpeg($file);
	$newim = imagecreatetruecolor($canvas_w,$canvas_h);
	imagecopyresampled($newim,$ims,0,0,0,0,$canvas_w,$canvas_h,imagesx($ims),imagesy($ims));
	if($gray){
        imagefilter($newim,IMG_FILTER_GRAYSCALE);
    }
    if($contrast){
        imagefilter($newim,IMG_FILTER_CONTRAST,$contrast);
    }
    $rgb = array();
	for($x=0;$x<$canvas_w;$x++){
		for($y=0;$y<$canvas_h;$y++){
			$rgb[] = imagecolorat($newim,$x,$y);
		}
	}
    return $rgb;
}

function match($match,$match2,$rate=25){
	foreach($match2 as $key=>$rgb){
		$r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        
        $r2 = ($match[$key] >> 16) & 0xFF;
        $g2 = ($match[$key] >> 8) & 0xFF;
        $b2 = $match[$key] & 0xFF;
        
        if(abs($r-$r2) < $rate && abs($g-$g2) < $rate && abs($b-$b2)< $rate){
            $match[$key] = 1;
            $match2[$key] = 1;
        }else{
            $match[$key] = 'a';
            $match2[$key] = 'b';
        }
	}
	similar_text(implode('',$match),implode('',$match2),$num);
    return $num;
}
