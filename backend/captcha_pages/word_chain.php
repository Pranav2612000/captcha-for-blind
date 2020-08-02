<?php
require '../config.php';
require '../helpers/add_placeholder.php';
require '../helpers/add_switch_languge.php';
require '../helpers/add_switch_region.php';
session_start();
?>
<link rel="stylesheet" href=<?php echo $base_url . "css/word_chain.css" ?>>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css" ?>>
<script src= <?php echo $base_url ."js/translate.js"?>/>
<script src= <?php echo $base_url ."js/changeRegion.js"?>/>
<script src= <?php echo $base_url ."js/record.js"?>/>
<script src= <?php echo $base_url ."js/keyhandlers.js"?>/>
<script src= <?php echo $base_url ."js/elementCheckers.js"?>/>
<script src= <?php echo $base_url ."js/get_audio.js"?>/>
<?php 
error_log($_SESSION['is_open']);
if(isset($_SESSION['is_open']) && $_SESSION['is_open'] == '0') {
  put_placeholder();
}
?>
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
    <!--<button class='ca-button' id="switch_lang" onclick="changeLanguage(event, 'word_chain')"><?php print $_SESSION["lang_switch"]; ?></button>-->
    <label class='ca-label'><?php print $_SESSION["lang_switch"]; ?></label>
    <?php 
      add_switch_language_elem();
    ?>
    <button class='ca-button' id='voice_inp' onclick="record(event)"><?php print $_SESSION["rec_ans"]; ?></button>
    <button class='ca-button'  name="audio" id="audio" value="Audio" onclick="getAudio(event)" autofocus ><?php print $_SESSION["audio"]; ?></button>
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

<div id='arrow'></div>
<script>
  function disp(str) {
    //alert(str);
    document.getElementById('arrow').innerHTML = str;
  }
</script>
