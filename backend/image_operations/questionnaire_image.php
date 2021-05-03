<?php
//image.php
require '../config.php';
session_start();
//$captcha_code = $index;
//
$q_secret = $_SESSION['q_secret_img'];
$cap_type = $_SESSION['captcha_type'];

 $ins1 =  $_SESSION['ins1'];
 $ins2 =  $_SESSION['ins2'];
 $ins3 =  $_SESSION['ins3'];
 $ins4 =  $_SESSION['ins4'];

if(isset($_GET['id'])) {
  $img_id = $_GET['id'];
  $question = $q_secret[$img_id];
  $num_of_newlines = substr_count($question, "\n") + 1;
  error_log($question);
}

if($cap_type== 'word_chain') {
  $question = $ins1 . $q_secret[0] . $ins2 . $q_secret[1] . $ins3 . $q_secret[2] . $ins4 . $q_secret[3];
}

if(isset($_GET['height'])) {
  $img_height = $_GET['height'];
}

if(isset($_GET['width'])) {
  $img_width = $_GET['width'];
}

/*
$q_string = $_SESSION['q_string'];
$q_secret = $_SESSION['q_secret'];

$txt = str_replace("|", $q_secret, $q_string);
 */

/* Create the image. */
/*$image = imagecreatetruecolor(500, 300);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, 500, 300, $background_color);
//$font = dirname(__FILE__) . '/../../assets/fonts/arial.ttf';
/*for ($x = 1; $x <= 300; $x++){
    $x1 = rand(0, 500);
    $y1 = rand(0, 500);
    $x2 = rand(0, 500);
    $y2 = rand(0, 500);
    
    imageline($image, $x1, $y1, $x2, $y2, $text_color);
}*/
/*$giffile = dirname(__FILE__) . '/../../assets/fonts/1.gif';
if(!$giffile)
    {
        /* Create a blank image */
        /*$im = imagecreatetruecolor (150, 30);
        $bgc = imagecolorallocate ($im, 255, 255, 255);
        $tc = imagecolorallocate ($im, 0, 0, 0);

        imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);*/

        /* Output an error message */
        /*imagestring ($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
    }

$image = imagecreatefromgif($giffile);
$imgResized = imagescale($image , 200, 400);*/

if($cap_type == 'digit_recognition' || $cap_type == 'touch'){
    $font = dirname(__FILE__) . '/../../assets/fonts/0/font0.ttf'; 
}
else{
    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'mr') {
        $font = dirname(__FILE__) . '/../../assets/fonts/Hind-Bold.ttf';
    } 
    else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'gu') {
        $font = dirname(__FILE__) . '/../../assets/fonts/guj.ttf';
    } 
    else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'hi') {
        $font = dirname(__FILE__) . '/../../assets/fonts/Hind-Bold.ttf';
    }
    else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'bn') {
        $font = dirname(__FILE__) . '/../../assets/fonts/bg.ttf';
    }
    else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'pa') {
        $font = dirname(__FILE__) . '/../../assets/fonts/pun.ttf';
    }
    else {

        # 0 - simple, 1 - distored
        error_log("in english");
        $randtype = rand(0, 1);
        //if($randtype == 0){
        if(true) {
            $randomNumber = rand(0,28); 
            $font = dirname(__FILE__) . '/../../assets/fonts/0/font' . $randomNumber . '.ttf';  
        }
        else {
            $randext = rand(0, 1);
            if($randext == 0){
                $randt = rand(87, 95);
                $font = dirname(__FILE__) . '/../../assets/fonts/1/TTF/font' . $randt . '.TTF';  
            }
            else if($randext == 1){
                $randt = rand(30, 86);
                $font = dirname(__FILE__) . '/../../assets/fonts/1/ttf/font' . $randt . '.ttf';  
            }
        }
    }
}

//$font = dirname(__FILE__) . '/../../assets/fonts/pun.ttf';


/*if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'pa') {
    $font = dirname(__FILE__) . '/../../assets/fonts/pun.ttf';
}
else{
    $font = dirname(__FILE__) . '/../../assets/fonts/0/font0.ttf';
}*/


/*$randomBgColor = rand(0,1);
if($randomBgColor == 0)
    $randomNumberForBg = rand(1,6); 
else
    $randomNumberForBg = rand(1,16);
*/
//$imgfile = dirname(__FILE__) . '/../../assets/backgrounds/1/10.png';


//$img = imagecreatefrompng($imgfile);

//$randjpeg = rand(0, 1);  #1 - jpeg , 0 -png
$randomBgColor = rand(0,5);
if($randomBgColor == 0){
    $randomNumberForBg = rand(1,7); 
}
else if($randomBgColor == 1){
    $randomNumberForBg = rand(2,16);
}
else if($randomBgColor == 2){
  $randomNumberForBg = rand(1,15); 
}
else if($randomBgColor == 3){
  $randomNumberForBg = rand(1,20); 
}
else if($randomBgColor == 4){
    $randomNumberForBg = rand(8,20); 
}
else if($randomBgColor == 5){
    $randomNumberForBg = rand(18,20); 
}


/*if($randjpeg == 1){
  $imgfile = dirname(__FILE__) . '/../../assets/backgrounds/'.$randomBgColor.'/jpeg/'.$randomNumberForBg.'.png';
}
else{*/
    if($randomBgColor == 0 || $randomBgColor == 1){
        $imgfile = dirname(__FILE__) . '/../../assets/backgrounds/'.$randomBgColor.'/'.$randomNumberForBg.'.png';
        $img = imagecreatefrompng($imgfile);
        
        /*$newHeight = 500;
        $newWidth = 400;
        list($width, $height) = getimagesize($img);
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $img = $tmp;*/

    }
    else {
        $imgfile = dirname(__FILE__) . '/../../assets/backgrounds/'.$randomBgColor.'/'.$randomNumberForBg.'.jpeg'; 
        $img = imagecreatefromjpeg($imgfile);

        /*
        $newHeight = 500;
        $newWidth = 400;
        list($width, $height) = getimagesize($img);
        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        $img = $tmp;
        */

    }
//}

//$img = imagecreatetruecolor(500, 400);
//$background_color = imagecolorallocate($img, 255, 255, 255);
//imagefilledrectangle($img, 0, 0, 500, 400, $background_color);
error_log($imgfile);
error_log($font);


$cropping_rect = ['x' => 0,
                  'y' => 0,
                  'width' => $img_width,
                  'height' => $img_height
                ];
$img = imagecrop($img, $cropping_rect );

/*if($randomBgColor == 0){
    $randomTextColor = rand(1, 2);
    if($randomTextColor == 1)
        $text_color = imagecolorallocate($img, 250, 250, 200); #cream
    else 
        $text_color = imagecolorallocate($img, 255, 255, 0);  #yellow
} else{
    $randomTextColor = rand(1, 4);
    if($randomTextColor == 1)
        $text_color = imagecolorallocate($img, 0, 0, 0); #black
    else if($randomTextColor == 2)
        $text_color = imagecolorallocate($img, 0, 0, 102); #blue
    else if($randomTextColor == 3)
        $text_color = imagecolorallocate($img, 122, 31, 31); #brown
    else
        $text_color = imagecolorallocate($img, 41, 10, 10); #dark brown
}*/

if($randomBgColor == 0 || $randomBgColor == 4){
    $randomTextColor = rand(1, 2);
    if($randomTextColor == 1)
        $text_color = imagecolorallocate($img, 250, 250, 200); #cream
    else 
        $text_color = imagecolorallocate($img, 255, 255, 0);  #yellow
} 
else if($randomBgColor == 1 || $randomBgColor == 5){
    $randomTextColor = rand(1, 4);
    if($randomTextColor == 1)
        $text_color = imagecolorallocate($img, 0, 0, 0); #black
    else if($randomTextColor == 2)
        $text_color = imagecolorallocate($img, 0, 0, 102); #blue
    else if($randomTextColor == 3)
        $text_color = imagecolorallocate($img, 122, 31, 31); #brown
    else
        $text_color = imagecolorallocate($img, 41, 10, 10); #dark brown
}
else if($randomBgColor == 2){
    $randomTextColor = rand(1, 2);
    if($randomTextColor == 1)
        $text_color = imagecolorallocate($img, 0, 0, 0); #black
    else 
        $text_color = imagecolorallocate($img, 0, 0, 102); #blue
}
else if($randomBgColor == 3){
    $randomTextColor = rand(1, 3);
    if($randomTextColor == 1)
        $text_color = imagecolorallocate($img, 250, 250, 200); #cream
    else if($randomTextColor == 2)
        $text_color = imagecolorallocate($img, 213, 93, 93); #light brown 
    else if($randomTextColor == 3)
        $text_color = imagecolorallocate($img, 255, 255, 128); #light yellow rgb(255, 255, 128) 


}


//$text_color= imagecolorallocate($img, 0, 0, 0);

// Decide no of lines to draw depending on the area
for ($x = 1; $x <= ($img_width * $img_height / 400); $x++){
    $x1 = rand(0, $img_width);
    $y1 = rand(0, $img_height);
    $x2 = rand(0, $img_width);
    $y2 = rand(0, $img_height);
    
    imageline($img, $x1, $y1, $x2, $y2, $text_color);
    //imagerectangle($img, $x1, $y1, $x2, $y2, $text_color);
    //imagearc($img, $x1, $y1, $x2, $y2, $x3, $y3, $text_color);

}
error_log($question);
//imagettftext($img, 50, 0, 15, $img_height/$num_of_newlines , $text_color, $font, $question);
if($cap_type == 'questionnaire') {
    imagettftext($img, 15, 0, 10, 20 , $text_color, $font, $question);
} else if($cap_type == 'word_chain') {
    imagettftext($img, 15, 0, 10, 20 , $text_color, $font, $question);
} else if($cap_type == 'object_detection') {
    imagettftext($img, 50, 0, 100, 80 , $text_color, $font, $question);
} else if($cap_type == 'pressure') {
    imagettftext($img, 40, 0, 40, 80 , $text_color, $font, $question);
} else {
    imagettftext($img, 50, 0, 160, 80 , $text_color, $font, $question);
}
imagepng($img);
imagedestroy($img);
