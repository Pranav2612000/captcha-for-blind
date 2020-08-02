<?php
    require '../config.php';
    session_start();
    function str_replace_first($search, $replace, $subject) {
          $pos = strpos($subject, $search);
          if ($pos !== false) {
              return substr_replace($subject, $replace, $pos, strlen($search));
          }
          return $subject;
    }

    $dir = $base_location . "assets/audio/";
    $file = "tts";
    $file = $dir . $file . ".wav";
    $lang = $_SESSION['lang'];
    $q_string = $_SESSION['q_string'];
    $q_secret = $_SESSION['q_secret_audio'];

    $txt = $q_string;
    /*for($i = 0; $i < count($q_secret); $i++) {
      $txt = str_replace_first("|", $q_secret[$i], $txt); 
    }*/
    error_log($txt);
    
    /* Encode the input. */
    $txt=htmlspecialchars($txt);
    $txt=rawurlencode($txt);
    
    /* create a directory(if not exists) to store the audio files */
    if (!is_dir($dir)) {
        mkdir($dir, 0, true);
    } else {
        if (substr(sprintf('%o', fileperms($dir)), -4) != "0777")
            chmod($dir, 0777);
    }

    /* Make the curl request to get audio file */
    /*$curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl='.$lang.'-IN',
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ]);
    $html = curl_exec($curl);
    curl_close($curl);*/

    /* save the audio file */
    //file_put_contents($file, $html);

    $captcha_type = $_SESSION['captcha_type'];
    $q = $_SESSION['pressure_type'];
    $touch_type = $_SESSION['touch_type'];
    $taps = $_SESSION['taps']; //1 to 6
    $shape_id = $_SESSION['shape_id']; //1 to 6
    $num = $_SESSION['answer'];


    $noise = $base_location . 'assets/sounds/guntrimmed.mp3';


    if($captcha_type == 'pressure'){
      if($q == 0){ //short
        $audio = $base_location . 'assets/audio/audios/ShortPress/'.$lang.'/shortPress.mp3';
      }
      else{ //long
        $audio = $base_location . 'assets/audio/audios/LongPress/'.$lang.'/LongPress.mp3';
      }
    }
    else if($captcha_type == 'touch'){
      if($touch_type == 0){ //press
          $audio = $base_location . 'assets/audio/audios/presstime/'.$lang.'/'.$taps.'.mp3';
      }
      else if($touch_type == 1){ //swipe
        $audio = $base_location . 'assets/audio/audios/swipe/'.$lang.'/swipe.mp3';
      }
    }
    else if($captcha_type == 'object_detection'){
      if($shape_id == 0) { //circle 
        $audio = $base_location . 'assets/audio/audios/circle/'.$lang.'/ci.mp3';
      }
      else if($shape_id == 1) { //triangle
        $audio = $base_location . 'assets/audio/audios/tri/'.$lang.'/tri.mp3'; 
      }
      else if($shape_id == 2) { //square
        $audio = $base_location . 'assets/audio/audios/rectangle/'.$lang.'/re.mp3'; 
      }

    }
    else if($captcha_type == 'digit_recognition'){
      $audio = $base_location . 'assets/audio/audios/digits/'.$lang.'/'.$num.'.mp3';
    }

    /*if($lang == 'hi'){
      if($txt == 'long press'){
        $audio = $base_location . 'assets/audio/.wav';
      } 
      else if($txt == 'short press'){

      }
      else if($txt == 'short press'){

      }
      else if($txt == 'short press'){

      }
      
    
    }
    else if($lang == 'gu'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins.mp3></audio>";
        echo $player1;
        return;
    }
    else if($lang == 'mr'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins1.mp3></audio>";
        echo $player1;
        return;
    }
    else if($lang == 'pa'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins2.mp3></audio>";
        echo $player1;
        return;
    }
    else {
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins3.mp3></audio>";
        echo $player1;
        return;
    }*/

    
    $post_params['noise'] = $noise;
    $post_params['sound'] = $audio;
    

    // Get cURL resource
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => 'http://localhost:5000/audio/',
      CURLOPT_USERAGENT => 'Codular Sample cURL Request',
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => $post_params 
    ]);
    #curl_setopt($curl, CURLOPT_HTTPHEADER, array ('Content-Type: application/json'));
    $html = curl_exec($curl);
    // Close request to clear up some resources
    curl_close($curl);


    /* TODO: Fix some words being cut. */
    /* execute python script to get combined audio in base 64 and delete created files*/
    //$result_last_line = exec("python3 Audio.py $audio $noise ");
    #$result_last_line = exec("python3 audio1.py $noise $audio");

    /* Alternate way */
    /*$o = shell_exec('ffmpeg -y -i guntrimmed.wav -i wav.wav -filter_complex "[0:0]volume=0.05[a];[1:0]volume=2.2[b];[a][b]amix=inputs=2:duration=longest" -c:a libmp3lame again100.mp3 2>&1');*/

    /* send the file to client */
    $player1="<audio autoplay><source src='data:audio/mpeg;base64,".$html."'></audio>";
  echo $player1;
