<?php
require '../config.php';
require '../helpers/add_placeholder.php';
require '../helpers/add_switch_languge.php';
require '../helpers/add_switch_region.php';
?>
<!--<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.11.2"></script>-->
<script type="text/javascript" src=<?php echo $base_url . "js/tf.js"?>></script>
<script type="text/javascript" src=<?php echo $base_url . "js/paint.js"?>></script>
<script type="text/javascript" src=<?php echo $base_url . "js/predicter.js"?>></script>
<script type="text/javascript" src= <?php echo $base_url ."js/translate.js"?>/>
<script src= <?php echo $base_url ."js/changeRegion.js"?>/>
<script src= <?php echo $base_url ."js/record.js"?>/>
<script src= <?php echo $base_url ."js/keyhandlers.js"?>/>
<script src= <?php echo $base_url ."js/elementCheckers.js"?>/>
<script src= <?php echo $base_url ."js/get_audio.js"?>/>
<script src= <?php echo $base_url ."js/switch_captcha.js"?>/>
<?php 
error_log($_SESSION['is_open']);
if(isset($_SESSION['is_open']) && $_SESSION['is_open'] == '0') {
  put_placeholder();
}
?>

<link href=<?php echo $base_url . "css/main.css"?> rel="stylesheet">
<link rel="stylesheet" href=<?php echo $base_url . "css/questionnaire.css"?>>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css"?>>

<div class="ca-panel-body">
  <form method="post" id="captcha_form">
    <label class='ca-label'>Draw a </label>
    <div class='ca-img-container'>
      <img src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=0&height=40&width=200"; ?> id="captcha_image" />
    </div>
    <div>
      <canvas id="canvas"></canvas> 
    </div>
    <!--<button class='ca-button' id='switch_lang' onclick="changeLanguage(event)">Switch language</button>-->

    <?php 
      add_switch_language_elem();
    ?>

    <input type="button" name="audio" id="audio" class="ca-button" value="Audio" onclick="getAudio()" autofocus/>
    <button class='ca-button' type="submit" name="register" id="change_captcha" value="use gesture captcha" onclick="switchCaptcha(event, 'gesture')">Gesture</button>
    <button class='ca-button' type="submit" name="register" id="change_captcha" value="use pressure captcha" onclick="switchCaptcha(event, 'pressure')">Pressure</button>
    <button class='ca-button' type="submit" name="register" id="submit" value="Check" ><?php print $_SESSION["check"]; ?></button>
    <input type="submit" name="register" id="submit" class="ca-button" value="Check"/>
    <div>
      <audio id="valid">
        <source src=<?php echo $base_url . "assets/sounds/valid.mp3"; ?> type="audio/mp3">
      </audio> 
       
      <audio id="enter">
        <source src=<?php echo $base_url . "assets/sounds/enter.mpeg"; ?> type="audio/mp3">
      </audio> 

      <audio id="invalid">
        <source src=<?php echo $base_url . "assets/sounds/invalid.mp3"; ?> type="audio/mp3">
      </audio>       
      <div id="player">
      </div>
    </div>
  </form>
</div>
<script>
var base_url = "<?php echo $base_url; ?>";
var lang = "<?php echo $_SESSION['lang']; ?>";
var region = "<?php echo $_SESSION['region']; ?>";
var is_open = "<?php echo $_SESSION['is_open']; ?>";
var body = document.getElementsByClassName('ca-panel-body')[0];
console.log(body);
console.log(is_open);
console.log(!is_open);
if(is_open == '0') {
  console.log('hreer');
  body.style.display="none";
}
var v = document.getElementById("valid"); 
var i = document.getElementById("invalid"); 
var e = document.getElementById("enter"); 
function getAudio(){
  var txt=jQuery('#txt').val();
  jQuery.ajax({
      /*url:'../audio_operations/word_chain_audio.php',*/
      url: base_url + "backend/audio_operations/word_chain_audio.php", 
      type:'post',
      success:function(result){
          jQuery('#player').html(result);
      }
  });
}
console.log('here');
$('#captcha_form').on('submit', function(event){
  event.preventDefault();
  event.stopPropagation();
  console.log(letter);
  $.ajax({
    url: base_url + "backend/validation/letter_recognition.php",
    method:"POST",
    data:{letter:letter["letter"]},
    success:function(data)
    {
      console.log(data)
      if(data == 'success') {
        v.play();
        alert("Successful Validation");
        $('.ca-panel-body').html("<h3 class='ca-validated'> Captcha Validated </h3>");
        //$('#register').attr('disabled', false);
      } else {
        i.play();
        alert("Unsuccessful validation");
        paintBackground();
        //$('#register').attr('disabled', 'disabled');
        //$('#captcha_image').attr('src', 'image.php');
        console.log('Invalid Code');
      }
      $('#captcha_form')[0].reset();
    }
  });
})
</script>


<div id='arrow'></div>
<script>
  function disp(str) {
    //alert(str);
    document.getElementById('arrow').innerHTML = str;
  }
</script>
