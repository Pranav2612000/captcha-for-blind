<?php

//check_code.php

session_start();

$answer = $_SESSION['answer'];
$code = $_POST['code'];
#$yes = $_SESSION['yes'];
#$no = $_SESSION['no'];
#$stmt = $_SESSION['stmt'];
$percent = 0;
$sim = similar_text($answer, $code, $percent);
if(strcasecmp($answer, $code) == 0 || $percent >= 70.00){
  header('Location: '.'../index.php');
  die();
} else {
	echo 'failure';
}

?>
