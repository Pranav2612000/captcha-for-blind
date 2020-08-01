<?php
require '../config.php';
session_start();

?>
<link rel="stylesheet" href=<?php echo $base_url . "css/word_chain.css" ?>>
<script src= <?php echo $base_url ."js/translate.js"?>/>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css" ?>>

<div class="ca-panel-body">
  <form method="post" id="captcha_form">
    <p><?php print $_SESSION["ins1"]; ?>
      <div class='ca-img-container'>
        <img class='ca-img' src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=0&width=200&height=48"; ?> id="captcha_image" />
      </div>
      <?php print $_SESSION["ins2"]; ?>
      <div class='ca-img-container'>
        <img src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=1&width=130&height=38"; ?> id="yes" />
      </div>
      <?php print $_SESSION["ins3"]; ?>
      <div class='ca-img-container'>
        <img src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=2&width=130&height=38"; ?> id="no" />
      </div>
      <?php print $_SESSION["ins4"]; ?>
    </p>
    <div class='ca-img-container'>
      <img src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=3&width=300&height=400"; ?> id="stmt" />
    </div>
    <label></label>
    <input class='ca-input' type="text" name="captcha_code" id="captcha_code" class="form-control" />
    <button class='ca-button' id="switch_lang" onclick="changeLanguage(event, 'word_chain')"><?php print $_SESSION["lang_switch"]; ?></button>
    <button class='ca-button' id='voice_inp' onclick="record(event)"><?php print $_SESSION["rec_ans"]; ?></button>
    <button class='ca-button'  name="audio" id="audio" value="Audio" onclick="getAudio()" autofocus ><?php print $_SESSION["audio"]; ?></button>
    <button class='ca-button' type="submit" name="register" id="submit" value="Check" ><?php print $_SESSION["check"]; ?></button>
    <!-- TODO: Modularize -->
    <audio id="valid">
      <source src=<?php echo $base_url . "assets/sounds/valid.mp3"; ?> type="audio/mp3">
    </audio>

    <audio id="enter">
      <source src=<?php echo $base_url . "assets/sounds/enter.mpeg"; ?> type="audio/mp3">
    </audio>

    <audio id="invalid">
      <source src=<?php echo $base_url . "assets/sounds/invalid.mp3"; ?> type="audio/mp3">
    </audio>
    <div id="ca-player">
    </div>
  </form>
</div>



<script>
  var base_url = "<?php echo $base_url; ?>";

  function record(e) {
    e.preventDefault();
    console.log('recording...');
    var recognitaion = new webkitSpeechRecognition();
    recognitaion.lang = "en-GB";
    recognitaion.onresult = function(event) {
      console.log(event);
      document.getElementById('captcha_code').value = document.getElementById('captcha_code').value + event.results[0][0].transcript;
    }
    recognitaion.start();
  }

  function getAudio() {
    var txt = jQuery('#txt').val();
    jQuery.ajax({
      /*url:'../audio_operations/word_chain_audio.php',*/
      url: base_url + "backend/audio_operations/word_chain_audio.php",
      type: 'post',
      success: function(result) {
        jQuery('#ca-player').html(result);
      }
    });
  }

  $(document).ready(function() {
    var v = document.getElementById("valid");
    var i = document.getElementById("invalid");
    var e = document.getElementById("enter");

    $('#captcha_form').on('submit', function(event) {
      event.preventDefault();
      var code = $('#captcha_code').val()
      console.log(code)
      if (code == '') {
        alert('Enter Captcha Code');
        //console.log("Here with empty code")
        //e.play();
        //$('#register').attr('disabled', 'disabled');
        return false;
      } else {
        // alert('Form has been validate with Captcha Code');
        $.ajax({
          url: base_url + "backend/validation/word_chain_validation.php",
          method: "POST",
          data: {
            code: code
          },
          success: function(data) {
            console.log(data)
            if (data == 'success') {
              v.play();
              alert("Successful Validation");
              $('.ca-panel-body').html("<h3 class='ca-validated'> Captcha Validated </h3>");
              //$('#register').attr('disabled', false);
            } else {
              i.play();
              alert("Unsuccessful validation");
              console.log('Invalid Code');
              $('#captcha_form')[0].reset();
            }
          }
        });
      }
    });
  });
</script>

<div id=arrow></div>
<script>
function isAInput(ele) {
  var inputs = document.getElementsByTagName('input');
  var inputs_array = [...inputs];
  if (inputs_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}

function disp(str) {
  //alert(str);
  document.getElementById('arrow').innerHTML = str;
}

document.addEventListener('keydown', function(e) {
  console.log(e);
  if(isAInput(e.target)) {
    return;
  }
  if(e.keyCode == 65) {
    console.log('a pressed');
    $('#audio').focus();
    return;
  } 
  if(e.keyCode == 87) {
    console.log('left arraw pressed');
    $("#captcha_code").focus();
    return;
  } 
  if(e.keyCode == 69) {
    console.log('right arrow pressed');
    $("#submit").focus();
    return;
  } 
  if(e.keyCode == 76) {
    console.log('up pressed');
    if($('#switch_lang')) {
      $("#switch_lang").focus();
    }
    return;
  }
  if(e.keyCode == 82) {
    console.log('down pressed');
    $('#voice_inp').focus();
    return;
  }
}, true);
</script>
