<?php
session_start();
$numOne = rand(1,9);
$numTwo = rand(1,9);
$numero = $numOne + $numTwo;
$display = $numOne."+".$numTwo." =";
$_SESSION["mathcaptchaAnswer"] = $numero;
$img = imagecreate(75,38);
$background = imagecolorallocate($img,255,255,255);
$text_colour = imagecolorallocate($img,33,37,41);
$text = $display;
$font = "./verdana.ttf"; # https://stackoverflow.com/a/15001557
imagettftext($img,16,0,0,26,$text_colour,$font,$text);
header("Content-type: image/png");
imagepng($img);
imagecolordeallocate($img,$text_colour);
imagecolordeallocate($img,$background);
imagedestroy($img);
?>
