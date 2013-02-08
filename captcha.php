<?php
session_start();
$code = rand(0,8999)+1000;
$_SESSION['vnewscaptcha'] = $code;
$i = imagecreate(45, 30);
$w = imagecolorallocate($i, 255, 255, 255);
$b = imagecolorallocate($i, 100,100,100);
imagefilledrectangle($i, 0, 0, 120, 50, $w);
imagecolortransparent($i,$w);
imagettftext($i, 20, rand(-3,3), 0,  27+rand(-3,3), $b, "css/fonts/bebas.ttf", substr($code,0,1));
imagettftext($i, 20, rand(-3,3), 10, 27+rand(-3,3), $b, "css/fonts/bebas.ttf", substr($code,1,1));
imagettftext($i, 20, rand(-3,3), 20, 27+rand(-3,3), $b, "css/fonts/bebas.ttf", substr($code,2,1));
imagettftext($i, 20, rand(-3,3), 30, 27+rand(-3,3), $b, "css/fonts/bebas.ttf", substr($code,3,1));
$y1 = rand(2,25); $y2 = rand(2,25);
for($j=1;$j<5;$j++)
	imageline($i, 0,$y1+$j, 45, $y2+$j, $b);
$y1 = rand(2,25); $y2 = rand(2,25);
header("Content-Type: image/png");
imagepng($i);
?>