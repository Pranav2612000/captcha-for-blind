<?php
require '../config.php';
require '../helpers/add_placeholder.php';
require '../helpers/add_switch_languge.php';
require '../helpers/add_switch_region.php';
require '../helpers/add_buttons.php';
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
<script src= <?php echo $base_url ."js/switch_captcha.js"?>/>
<script src= <?php echo $base_url ."js/play_initialaudio.js"?>/>
<script src= <?php echo $base_url ."js/buttons.js"?>/>
<div class='ca-container'>
<div class="ca-panel-body">
  <form method="post" id="captcha_form">
    <!--<label class='ca-label'>Pressure Captcha</label>-->
    <div class='ca-img-container'>
      <img src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=0&width=400&height=150&refresh=" . rand(1,10); ?> id="captcha_image" />
    </div>
    <div class='form-buttons'>
      <div class='captcha-answer'>
          <input type="text" id="captcha_code" name="answer" autofocus>
      </div>
      <div class='captcha-submit'>
          <button class='captcha-submit-button' type="submit">Submit</button>
      </div>
    </div>
    <?php
      add_buttons();
      //add_switch_language_elem("pressure");
    ?>

    <audio id="valid">
      <source src=<?php echo $base_url . "assets/sounds/valid.mp3"; ?> type="audio/mp3">
    </audio> 
     
    <audio id="enter">
      <source src=<?php echo $base_url . "assets/sounds/enter.mpeg"; ?> type="audio/mp3">
    </audio> 

    <audio id="invalid">
      <source src=<?php echo $base_url . "assets/sounds/invalid.mp3"; ?> type="audio/mp3">
    </audio>       
    <div id="ca-player"></div>
  </form>
</div>
<?php 
error_log($_SESSION['is_open']);
put_placeholder();
?>
<script>
  var base_url = "<?php echo $base_url; ?>";
  var is_open = "<?php echo $_SESSION['is_open']; ?>";
  var lang = "<?php echo $_SESSION['lang']; ?>";
  var region = "<?php echo $_SESSION['region']; ?>";
  var elem_width = document.getElementsByClassName("ca-panel-body")[0].getBoundingClientRect()
  elem_width = elem_width.width;
  img_width = elem_width - 20;
  var v = document.getElementById("valid"); 
  var i = document.getElementById("invalid"); 
  var e = document.getElementById("enter"); 
  var is_open = "<?php echo $_SESSION['is_open']; ?>";
  var body = document.getElementsByClassName('ca-panel-body')[0];
  var ended = true;
  var validation_com = false;

  console.log(body);
  console.log(is_open);
  console.log(!is_open);
  if(is_open == '0') {
    console.log('hreer');
    body.style.display="none";
  } else {
    $("#cap_open").show("1000");
    $("#cap_closed").hide("1000");
    audio = new Audio( base_url + 'assets/audio/guides/page_load.mp3');
    audio.play();
    ended = false;
  }
  $('.ca-img').attr("src", base_url + "backend/image_operations/questionnaire_image.php?id=0&height=400&width=" + img_width);

  $(document).ready(function() {
    var body = document.getElementsByClassName('ca-panel-body')[0];

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
              var placeholder = document.getElementsByClassName("ca-placeholder-body")[0]; 
              placeholder.style.border = "4px solid green";
              $('.ca-panel-body').hide(1000);
              tick_img = "<img class='ca-val-image' src='" + base_url + "assets/images/tick.jpeg'/>";
              $('.ca-placeholder-body').html(tick_img + "<h3 class='ca-validated'> Captcha Validated</h3>");
              ended = true;
              validation_com = true;
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
