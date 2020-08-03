<?php

require './translate.php';
//require './helpers/lang_trans.php';
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("log_errors", 1);
session_start();

if(isset($_SESSION['num_of_validations']) && $_SESSION['num_of_validations'] != 0) {
  error_log("session already present");
  error_log($_SESSION['num_of_validations']);
  $_SESSION['num_of_validations'] = $_SESSION['num_of_validations'] + 1;
  if($_SESSION['num_of_validations'] > 1) {
    $_SESSION['num_of_validations'] = 0;
    echo "success";
    exit();
  }
} else {
  error_log("starting new seesion");
  $_SESSION['num_of_validations'] = 0;
  $lang = "en";
  $is_open = "0";
  $region = "default";
}


if(isset($_POST['lang'])) {
  $lang = $_POST['lang'];
}

if(isset($_POST['open'])) {
  $is_open = $_POST['open'];
}

if(isset($_POST['region'])) {
  $region = $_POST['region'];
}



error_log($lang);
$_SESSION['lang'] = $lang;
$_SESSION['region'] = $region;
$_SESSION['is_open'] = $is_open;

if($region === "punjab") {
  $questionnaire_arr = array("Identify the capital \nof Punjab? .\n1) Chandigad .\n2) Mumbai.\n3) Chennai.\n4) Hydarabad."  => 'Chandigad', "Which of these is the \nfolk dance of Punjab  .\n1) Kuchipudi .\n2) Bhangra.\n3) Ghumar.\n4) Kathakali."  => 'Bhangra', "Which of these \nis in Punjab?  .\n1) Golden Temple .\n2) Taj Mahal.\n3) Gateway of India.\n4) Agra Fort."  => 'Golden Temple');
}
else if($region === "maharastra") {
  $questionnaire_arr = array("Where is \nShanivar vada? .\n1) Delhi .\n2) maharshtra.\n3) kasmir.\n4) Gujarat."  => 'maharshtra', "Guess city of \nMaharashtra?  .\n1) Amritsar .\n2) Gandhinagar .\n3) Hyderabad.\n4) Pune."  => 'Pune', "Where is lonaval? .\n1) Gujarat .\n2) Rajasthan .\n3) maharashtra.\n4) Kasmir."  => 'maharshtra', "What is the Capital \nof Maharashtra?  .\n1) Mumbai .\n2) Assam .\n3) West Bengal.\n4) Gujarat."  => 'Mumbai', "Which is a famous \nMaharashtrian festival?  .\n1)Gudi padwa  .\n2) Onam.\n3) Durga Pooja.\n4) Eid."  => 'Gudi padwa',);
}
else if($region === "andhrapradesh") {
  $questionnaire_arr = array("Identify non south \nIndian food? .\n1) Dosa .\n2) idlis.\n3) Vada pav.\n4) Uttapams."  => 'Vada pav', "Who is famous south \nIndian Actor?  .\n1) Rajnikant .\n2) Salman Khan.\n3) Akshay Kumar .\n4) Shahrukh Khan."  => 'Rajnikant');
}
else if($region === "westbengal") {
  $questionnaire_arr = array("Identify a famous \nbengali sweet?  .\n1) Laddu .\n2) Kulfi.\n3) Rasgulla.\n4) Dosa."  => 'Rasgulla', "Which is a famous \nbengali festival?  .\n1) Gudi padwa  .\n2) Onam.\n3) Durga Pooja.\n4) Eid."  => 'Durga Pooja');
}
else{
  $questionnaire_arr = array("Identify the animal.\n1) Elephant.\n2) Hibiscus.\n3) Earth.\n4) Sun."  => 'elephant', "Identify the animal.\n1) Dog.\n2) China.\n3) Banana.\n4) Apple. " => 'dog', "Identify the animal.\n1) Mango.\n2) Apple.\n3) Cat.\n4) Peach. " => 'cat', "Identify the animal.\n1) Mars.\n2) Dog.\n3) Earth.\n4) Sun. " => 'dog', "Identify the animal.\n1) Cat.\n2) Banana.\n3) Earth.\n4) Sun. " => 'cat', "Identify the flower.\n1) Dog.\n2) Lotus.\n3) Banana.\n4) Apple. " => 'lotus', "Identify the flower.\n1) Mango.\n2) Apple.\n3) Rose.\n4) Peach. " => 'rose',"Identify the planet.\n1) Dog.\n2) China.\n3) Banana.\n4) Earth. " => 'earth' , "Identify the day.\n1) Sunday.\n2) China.\n3) Banana.\n4) Apple. " => 'sunday', "Identify the month.\n1) Elephant.\n2) December.\n3) Earth.\n4) Sun. " => 'december', "what is India \ncalled in hindi?  .\n1) Bharat.\n2) China.\n3) Delhi.\n4) Africa."  => 'Bharat', "What is the Capital \nof India?  .\n1) Delhi.\n2) Nepal.\n3) Kashmir.\n4) Assam."  => 'Delhi', );
}

$shapes_arr = array('circle', 'triangle', 'square');
$pressure_arr= array("short press", "long press");
//$questionnaire_arr = array("Identify the animal.\n1) Elephant.\n2) Hibiscus.\n3) Earth.\n4) Sun."  => 'elephant', "Identify the animal.\n1) Dog.\n2) China.\n3) Banana.\n4) Apple. " => 'dog', "Identify the animal.\n1) Mango.\n2) Apple.\n3) Cat.\n4) Peach. " => 'cat', "Identify the animal.\n1) Mars.\n2) Dog.\n3) Earth.\n4) Sun. " => 'dog', "Identify the animal.\n1) Cat.\n2) Banana.\n3) Earth.\n4) Sun. " => 'cat', "Identify the flower.\n1) Dog.\n2) Lotus.\n3) Banana.\n4) Apple. " => 'lotus', "Identify the flower.\n1) Mango.\n2) Apple.\n3) Rose.\n4) Peach. " => 'rose',"Identify the planet.\n1) Dog.\n2) China.\n3) Banana.\n4) Earth. " => 'earth' , "Identify the day.\n1) Sunday.\n2) China.\n3) Banana.\n4) Apple. " => 'sunday', "Identify the month.\n1) Elephant.\n2) December.\n3) Earth.\n4) Sun. " => 'december');
$word_chain_arr = array("dog", "cat", "cow", "sheep", "lion", "tiger", "monkey", "donkey", "hibiscus", "tulip", "rose", "lotus", "sunflower", "apple", "lemon", "orange", "fig", "grapes", "banana", "kiwi", "peach", "potato", "spinach", "mushroom", "cabbage", "beetroot", "corn", "carrot", "plum", "apricot", "broccoli", "cauliflower", "olive", "sun", "moon", "venus", "mercury", "earth", "mars", "jupiter", "saturn", "uranus", "neptune", "january", "february", "march", "april", "may", "june", "july", "september", "october", "november", "december", "sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "is", "are", "was", "were", "will", "animal", "flower", "fruit", "flower", "planet", "month");

$touch_array = array("press", "swipe");
$touch_array_hi = array("दबाएँ", "टचपैड पर हाथ ले जाएं");
$touch_array_gu = array("દબાવો", "ટચપેડ પર હાથ ખસેડો");
$touch_array_mr = array("दाबा", "टचपॅडवर हात हलवा");
$touch_array_bn = array("প্রেস", "টাচপ্যাডে হাত সরিয়ে দিন");
$touch_array_pa = array("ਪ੍ਰੈਸ", "ਟਚਪੈਡ 'ਤੇ ਹੱਥ ਭੇਜੋ");




function getUniqueRandomNumbersWithinRange($min, $max, $quantity) {
  $numbers = range($min, $max);
  shuffle($numbers);
  return array_slice($numbers, 0, $quantity);
}

function getElement($index) {
  return $GLOBALS['word_chain_arr'][$index]; 
}

if(isset($_SESSION['validated']) && $_SESSION["validated"] == 'true') {
  echo "Validated";
}
if(isset($_POST['captcha_type'] ) && $_POST['captcha_type'] != 'random') {
  $captcha_type = $_POST['captcha_type'];
  if($captcha_type == "gesture") {
    $gesture = ["object_detection", "digit_recognition"];
    $type = array_rand($gesture);
    $type = $gesture[$type];
    $captcha_type = $type;
  } else if($captcha_type == 'pressure') {
    $pressure = ["touch", "pressure"];
    $type = array_rand($pressure);
    $type = $pressure[$type];
    $captcha_type = $type;
  } /*else if($captcha_type == 'audio') {
    $audio = ["questionnaire", "word_chain"];
    $type = array_rand($audio);
    $type = $audio[$type];
    $captcha_type = $type;
  }*/
  $_SESSION['captcha_type'] = $captcha_type;
  echo "redirecting to " . $captcha_type;
} else{
  $randgesture = rand(1, 4);
  if($randgesture == 1){
    $captcha_type = 'touch';
  }
  else if($randgesture == 2){ 
    $captcha_type = 'pressure';
  }
  else if($randgesture == 3){ 
    $captcha_type = 'digit_recognition';
  }
  else if($randgesture == 4){ 
    $captcha_type = 'object_detection';
  }
  $_SESSION['captcha_type'] = "random";
}

// Simple Captcha
if($captcha_type == 'simple') {
  //TODO: problems with audio of 'e'

  //Get random letters
  $random_alpha = md5(rand());

  // Trim to 6 letters
  $captcha_code = substr($random_alpha, 0, 6);

  // Add , between letters for accurate audio conversion
  $captcha_code_audio = implode(",", str_split($captcha_code));

  // Save these in session variables
  $_SESSION['q_string'] = "Type the following letters |";
  $_SESSION['q_secret_img'] = [$captcha_code];
  $_SESSION['q_secret_audio'] = [$captcha_code_audio];
  $_SESSION['answer'] = $captcha_code;

  // Send corresponding captcha page to client
  header('Location: '.'./captcha_pages/simple.php');
  die();
}

// Questionnaire Captcha
if($captcha_type == 'questionnaire') {

  // Choose a random question from array of questions
  $question = array_rand($questionnaire_arr);

  //harded coded text 
  if($lang == 'en') {
    $ins1 = "Solve the question below and write your answer in the space provided below";
    $ins2 = "Select the region";
    $lang_switch = "Switch language";
    $rec_ans = "Record Answer";
    $audio = "Audio";
    $check = "Check";

  }
  else if($lang == 'hi'){
    $ins1 = "नीचे दिए गए प्रश्न को हल करें और नीचे दिए गए स्थान पर अपना उत्तर लिखें";
    $ins2 = "क्षेत्र का चयन करें";
    $lang_switch = "भाषा अनुवाद";
    $rec_ans = "आवाज़ डालना";
    $audio = "आवाज़";
    $check = "उत्तर";
  }
  else if($lang == 'gu'){
    $ins1 = "નીચેનો પ્રશ્ન ઉકેલો અને નીચે આપેલ જગ્યામાં તમારા જવાબો લખો";
    $ins2 = "પ્રદેશ પસંદ કરો";
    $lang_switch = "ભાષા અનુવાદ";
    $rec_ans = "વ .ઇસ ઇનપુટ";
    $audio = "અવાજ";
    $check = "જવાબ";
  }
  else if($lang == 'mr'){
    $ins1 = "खाली प्रश्न सोडवा आणि खाली उत्तर दिलेल्या जागेवर आपले उत्तर लिहा";
    $ins2 = "प्रदेश निवडा";
    $lang_switch = "भाषा बदल";
    $rec_ans = "इनपुट आवाज";
    $audio = "आवाज";
    $check = "उत्तर";
  }
  else if($lang == 'bn'){
    $ins1 = "নীচের প্রশ্নটি সমাধান করুন এবং নীচের প্রদত্ত স্থানটিতে আপনার উত্তর লিখুন";
    $ins2 = "অঞ্চলটি নির্বাচন করুন";
    $lang_switch = "ভাষা অনুবাদ";
    $rec_ans = "ইনপুট ভয়েস";
    $audio = "কণ্ঠস্বর";
    $check = "উত্তর";
  }
  else if($lang == 'pa'){
    $ins1 = "ਹੇਠਾਂ ਦਿੱਤੇ ਪ੍ਰਸ਼ਨ ਦਾ ਹੱਲ ਕਰੋ ਅਤੇ ਹੇਠਾਂ ਦਿੱਤੀ ਜਗ੍ਹਾ ਵਿੱਚ ਆਪਣੇ ਉੱਤਰ ਲਿਖੋ";
    $ins2 = "ਖੇਤਰ ਦੀ ਚੋਣ ਕਰੋ";
    $lang_switch = "ਭਾਸ਼ਾ ਅਨੁਵਾਦ";
    $rec_ans = "ਇੰਪੁੱਟ ਆਵਾਜ਼";
    $audio = "ਆਵਾਜ਼";
    $check = "ਜਵਾਬ";

  }

  // Break into comma seperated individual words to improve translation
  $text_to_be_translated = implode(",", explode("\n", $question)); 

  // Join back translated words 
  $translated_text = implode("\n", explode(",", translate($text_to_be_translated, $lang))); 

  $answer = $questionnaire_arr[$question];

  // Save these values in session variables
  $_SESSION['q_string'] = "|";
  $_SESSION['q_secret_img'] = [$translated_text];
  $_SESSION['q_secret_audio'] = [$translated_text];
  $_SESSION['answer'] = $answer; 
  $_SESSION['ins1'] = $ins1;
  $_SESSION['ins2'] = $ins2;
  $_SESSION['lang_switch'] = $lang_switch;
  $_SESSION['rec_ans'] = $rec_ans;
  $_SESSION['audio'] = $audio;
  $_SESSION['check'] = $check;


  
  

  // Send corresponding captcha page to client
  header('Location: '.'./captcha_pages/questionnaire.php');
  die();
}

// Word-Chain Captcha
if($captcha_type == 'word_chain') {

  // Get multiple random elements from word_chain array
  $random_index = getUniqueRandomNumbersWithinRange(0, count($word_chain_arr), 8);
  $random_array = array_map("getElement", $random_index);

  // translate the chosen elements
  $str_to_be_translated= implode(", ", $random_array);
  $translated_str = translate($str_to_be_translated, $lang);
  $random_array = explode(", ", $translated_str);

  // create the options string
  $stmt = "";
  for($i = 0; $i < 7; $i++){
      $index = $random_index[$i]; 
      //$stmt = $stmt."\n".$word_chain_arr[$index];
      $stmt = $stmt."\n". $random_array[$i];
  }

  //$_SESSION['stmt'] = $stmt;

  //Randomly decide if object is present or not.
  $elem_in_stmt = rand(0,1);

  //Get the word to be checked for membership.
  $word="";
  if($elem_in_stmt) {
    $elem_index = rand(0, 6);
    //$word = $word_chain_arr[$random_index[$elem_index]];
    $word = $random_array[$elem_index];
  } else {
    $word = $random_array[7];
  }

  //Get the buttons to be pressed for yes & no cases.
  $seed = str_split('abcdefghijklmnopqrstuvwxyz'); // TODO: Add other possible buttons.
  shuffle($seed); 
  $yes = $seed[0];
  $no = $seed[1];

  // Save these values in session variables
  $_SESSION['yes'] = $yes;
  $_SESSION['no'] = $no;
  #$_SESSION['question'] = translateQuestion($lang, $word, $yes, $no, $stmt);
  $_SESSION['q_secret_img'] = [$word, $yes, $no, $stmt];
  $_SESSION['q_secret_audio'] = [$word, $yes, $no, $stmt];
  #$_SESSION['q_string'] = "If | is present in given statement then press | else press | . The words are | "; 
  $_SESSION['q_string'] = getWordChainQuestion($lang); 


  //hardcoded text translate
  if($lang == 'en') {
    $ins1 = "If";
    $ins2 = "is present in given statement, then press";
    $ins3 = "else, press";
    $ins4 = "The words are:";
    $lang_switch = "Switch language";
    $rec_ans = "Record Answer";
    $audio = "Audio";
    $check = "Check";

  }
  else if($lang == 'hi'){
    $ins1 = "अगर";
    $ins2 = "दिए गए कथन में मौजूद है, फिर दबाएँ";
    $ins3 = "और, दबाओ";
    $ins4 = "शब्द हैं";
    $lang_switch = "भाषा अनुवाद";
    $rec_ans = "आवाज़ डालना";
    $audio = "आवाज़";
    $check = "उत्तर";
  }

  $_SESSION['ins1'] = $ins1;
  $_SESSION['ins2'] = $ins2;
  $_SESSION['ins3'] = $ins3;
  $_SESSION['ins4'] = $ins4;
  $_SESSION['lang_switch'] = $lang_switch;
  $_SESSION['rec_ans'] = $rec_ans;
  $_SESSION['audio'] = $audio;
  $_SESSION['check'] = $check;

 

  // Send corresponding captcha page to client
  header('Location: '.'./captcha_pages/word_chain.php');
  die();
}

// Touch Captcha
if($captcha_type == 'touch') {
  // choose between press and swipe. If press ,chose a random no for num of touches between 1 and 5.
  $question = rand(0, 1);
  $no_of_presses = rand(1, 6);
  
  if($lang == 'hi'){
    $t = "बार";
    if($question== 0) {
      $question_stmt = $touch_array_hi[$question] . " " . $no_of_presses . $t;
    }
    else {
      $question_stmt = $touch_array_hi[$question]; 
      $no_of_presses = "none";
    }

  }
  else if($lang == 'gu'){
    $t = "વખત";
    if($question== 0) {
      $question_stmt = $touch_array_gu[$question] . " " . $no_of_presses . $t;
    }
    else {
      $question_stmt = $touch_array_gu[$question]; 
      $no_of_presses = "none";
    }

  }
  else if($lang == 'mr'){
    $t = "वेळा";
    if($question== 0) {
      $question_stmt = $touch_array_mr[$question] . " " . $no_of_presses . $t;
    }
    else {
      $question_stmt = $touch_array_mr[$question]; 
      $no_of_presses = "none";
    }

  }
  else if($lang == 'bn'){
    $t = "বার";
    if($question== 0) {
      $question_stmt = $touch_array_bn[$question] . " " . $no_of_presses . $t;
    }
    else {
      $question_stmt = $touch_array_bn[$question]; 
      $no_of_presses = "none";
    }
  }
  else if($lang == 'pa'){
    $t = "ਵਾਰ";
    if($question== 0) {
      $question_stmt = $touch_array_pa[$question] . " " . $no_of_presses . $t;
    }
    else {
      $question_stmt = $touch_array_pa[$question]; 
      $no_of_presses = "none";
    }

  }
  else{
    $t = "times";
    if($question== 0) {
      $question_stmt = $touch_array[$question] . " " . $no_of_presses . $t;
    }
    else {
      $question_stmt = $touch_array[$question]; 
      $no_of_presses = "none";
    }
  
  }

  // translate the text by converting to csv first
  //$text_to_be_translated = implode(",", explode("\n", $question_stmt)); 
  //$translated_text = implode("\n", explode(",", translate($text_to_be_translated, $lang))); 
  //lang_translate($lang);

  // set values
  $_SESSION['touch_type'] = $question;
  $_SESSION['taps'] = $no_of_presses;
  $_SESSION['q_secret_audio'] = [$question_stmt];
  $_SESSION['q_secret_img'] = [$question_stmt];
  $_SESSION['q_string'] = "Perform the following | "; 

  // send page to client
  header('Location: '.'./captcha_pages/touch.php');
  die();
}

// Scribble detection captcha
if($captcha_type == 'object_detection') {
  // choose a random shape that is to be drawn
  $question = array_rand($shapes_arr);

  // set session values
  $_SESSION['shape_id'] = $question;
  $shape = translate($shapes_arr[$question], $lang);
  $_SESSION['q_secret_img'] = [$shape];
  $_SESSION['q_secret_audio'] = [$shape];
  $_SESSION['q_string'] = "Draw a | "; 

  // send page to client
  header('Location: '.'./captcha_pages/object_detection.php');
  die();
}

// pressure detection captcha
if($captcha_type == 'pressure') {

  //choose a random type of question
  $question = array_rand($pressure_arr);
  //$pressure_type = translate($pressure_arr[$question], $lang);
  /*if($lang == 'hi'){
    if($question == 0){
      $pressure_type = 'कम तक दबाना';
    } 
    else if($question == 1){
      $pressure_type = 'देर तक दबाना';
    }
  
  }*/
  /*else if($lang == 'gu'){
    if($question == 'long press'){
      $pressure_type = '';
    } 
    else if($txt == 'short press'){
      $pressure_type = '';
    } 
  }
  else if($lang == 'mr'){
    if($question == 'long press'){
      $pressure_type = '';
    } 
    else if($txt == 'short press'){
      $pressure_type = '';
    }

  }
  else if($lang == 'pa'){
    if($question == 'long press'){
      $pressure_type = '';
    } 
    else if($txt == 'short press'){
      $pressure_type = '';
    }
  }*/
  /*else {
    if($question == 0){
      $pressure_type = 'short press';
    } 
    else if($txt == 1){
      $pressure_type = 'long press';
    }
  }*/

  
  if($lang == 'hi'){
    if($question == 0){
        $pressure_type = 'धीमा तक दबाना';
    }
    else{
      $pressure_type = 'देर तक दबाना';
    } 
  }
  else if($lang == 'gu'){
    if($question == 0){
        $pressure_type = 'ધીમું પ્રેસ';
    }
    else{
      $pressure_type = 'લાંબા પ્રેસ';
    } 
  }
  else if($lang == 'mr'){
    if($question == 0){
        $pressure_type = 'मंद दाबा';
    }
    else{
      $pressure_type = 'लांब दाबा';
    } 
  }
  else if($lang == 'bn'){
    if($question == 0){
        $pressure_type = 'ধীর চাপ';
    }
    else{
      $pressure_type = 'দীর্ঘ চাপ';
    } 
  }
  else if($lang == 'pa'){
    if($question == 0){
        $pressure_type = 'ਹੌਲੀ ਪ੍ਰੈਸ';
    }
    else{
      $pressure_type = 'ਲੰਬੇ ਪ੍ਰੈਸ';
    } 
  }
  else{
    if($question == 0){
      $pressure_type = 'short press';
    }
    else{
      $pressure_type = 'long press';
    }
  }
  
  // set session values 
  $_SESSION['pressure_id'] = $pressure_type; 
  $_SESSION['pressure_type'] = $question; 
  $_SESSION['q_secret_audio'] = [$pressure_type];
  $_SESSION['q_secret_img'] = [$pressure_type];
  $_SESSION['q_string'] = " | the given area"; 

  // send page to client
  header('Location: '.'./captcha_pages/simple_pressure.php');
  die();
}

// letter recognition captcha
if($captcha_type == 'letter_recognition') {

  //Choose a random letter
  $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // TODO: Add other possible buttons.
  shuffle($seed); 
  $letter = $seed[0];

  $_SESSION['answer'] = $letter;
  $_SESSION['q_secret_audio'] = [$letter];
  $_SESSION['q_secret_img'] = [$letter];
  $_SESSION['q_string'] = "Draw letter | in the given area"; 

  // send page to client
  header('Location: '.'./captcha_pages/letter_recognition.php');
  die();
}

if($captcha_type == 'digit_recognition') {

  //Choose a random letter
  $seed = str_split('0123456789'); // TODO: Add other possible buttons.
  shuffle($seed); 
  $num = $seed[0];

  $_SESSION['answer'] = $num;
  $_SESSION['q_secret_audio'] = [$num];
  $_SESSION['q_secret_img'] = [$num];
  $_SESSION['q_string'] = "Draw number | "; 

  // send page to client
  header('Location: '.'./captcha_pages/digit_recognition.php');
  die();
}
