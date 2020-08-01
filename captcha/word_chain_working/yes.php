<?php

//image.php

session_start();

#$random_alpha = md5(rand());

#$random_alpha = substr(md5(microtime()),rand(0,26),1);

$seed = str_split('abcdefghijklmnopqrstuvwxyz'); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$yes = $seed[0];

#$captcha_code = substr($random_alpha, 0, 6);

$_SESSION['yes'] = $yes;

header('Content-Type: image/png');

$image = imagecreatetruecolor(130, 38);

$background_color = imagecolorallocate($image, 255, 255, 255);

$text_color = imagecolorallocate($image, 0, 0, 0);

imagefilledrectangle($image, 0, 0, 130, 38, $background_color);

$font = dirname(__FILE__) . '/arial.ttf';

for ($x = 1; $x <= 50; $x++){
    $x1 = rand(0, 130);
    $y1 = rand(0, 130);
    $x2 = rand(0, 130);
    $y2 = rand(0, 130);
    
    imageline($image, $x1, $y1, $x2, $y2, $text_color);
}

imagettftext($image, 20, 0, 60, 28, $text_color, $font, $yes);

imagepng($image);

imagedestroy($image);

?>
