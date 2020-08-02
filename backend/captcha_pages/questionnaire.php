<?php
require '../config.php';
require '../helpers/add_placeholder.php';
?>
<!--
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
-->
<link rel="stylesheet" href=<?php echo $base_url . "css/questionnaire.css"?>>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css"?>>
<script src= <?php echo $base_url ."js/translate.js"?>/>
<script src= <?php echo $base_url ."js/changeRegion.js"?>/>
<?php 
error_log($_SESSION['is_open']);
if(isset($_SESSION['is_open']) && $_SESSION['is_open'] == '0') {
  put_placeholder();
}
?>
<div class="ca-panel-body">
  <form method="post" id="captcha_form">
    <label class='ca-label'><?php print $_SESSION["ins2"]; ?></label>
    <div>
      <select name="region" id="region" onchange="changeRegion(event)">
        <option value="default">Default</option>
        <option value="punjab">Punjab</option>
        <option value="andhrapradesh">Andhra Pradesh</option>
        <option value="maharastra">Maharastra</option>
        <option value="westbengal">West Bengal</option>
      </select>
    </div>

    <label class='ca-label'><?php print $_SESSION["ins1"]; ?></label>
    <div class='ca-img-container'>
      <img class="ca-img" id="captcha_image" />
    </div>
    <input class='ca-input' type="text" name="captcha_code" id="captcha_code" class="form-control" autocomplete="off"/>
    <button class='ca-button' id='switch_lang' onclick="changeLanguage(event, 'questionnaire')"><?php print $_SESSION["lang_switch"]; ?></button>
    <div>
      <select name="lang" id="lang" onchange="changeLanguage(event, 'questionnaire')">
        <option value="en" >English</option>
        <option value="hi">Hindi</option>
        <option value="gu">Gujarati</option>
        <option value="mr">Marathi</option>
        <option value="bn">Bengali</option>
        <option value="pa">Punjabi</option> 
      </select>
    </div>

    <button class='ca-button' id='voice_inp' onclick="record(event)"><?php print $_SESSION["rec_ans"]; ?></button>
    <button class='ca-button'  name="audio" id="audio" value="Audio" onclick="getAudio()" autofocus ><?php print $_SESSION["audio"]; ?></button>
    <button class='ca-button' type="submit" name="register" id="submit" value="Check" ><?php print $_SESSION["check"]; ?></button>

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

<script>
  var base_url = "<?php echo $base_url; ?>"; 
  var is_open = "<?php echo $_SESSION['is_open']; ?>";
  var lang = "<?php echo $_SESSION['lang']; ?>";
  var region = "<?php echo $_SESSION['region']; ?>";
  var elem_width = document.getElementsByClassName("ca-panel-body")[0].getBoundingClientRect()
  elem_width = elem_width.width;
  img_width = elem_width - 20;
  $('.ca-img').attr("src", base_url + "backend/image_operations/questionnaire_image.php?id=0&height=400&width=" + img_width);
  $(document).ready(function() {
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
    $("#lang").val(lang);
    $("#region").val(region);

    $('#captcha_form').on('submit', function(event) {
      event.preventDefault();
      var code = $('#captcha_code').val();
      if (code == '') {
        alert('Enter Captcha Code');
        return false;
      } else {
        $.ajax({
          url: base_url + "backend/validation/questionnare_validation.php",
          method: "POST",
          data: {
            code: code
          },
          success: function(data) {
            if (data == 'success') {
              v.play();
              alert("Successful Validation");
              $('.ca-panel-body').html("<h3 class='ca-validated'> Captcha Validated </h3>");
            } else {
              i.play();
              alert("Unsuccessful Validation");
              console.log('Invalid Code');
              $('#captcha_form')[0].reset();
              //alert('Invalid Code');
            }
          }
        });
      }
    });
  });
</script>

<div id=arrow></div>
<script>
  function disp(str) {
    //alert(str);
    document.getElementById('arrow').innerHTML = str;
    document.onkeydown = function() {
      switch (window.event.keyCode) {
        case 38:
          $("input:text").focus();
          break;

        case 39:
          $('#register').focus();
          break;

        case 40:
          $('#audio').focus();
          break;

      }
    }
  };
</script>
<script type="text/javascript">
function record(e) {
  e.preventDefault();
  console.log('recording...');
  var recognitaion = new webkitSpeechRecognition();
  var lang = document.getElementById("lang").value;
  console.log(lang)
  console.log("helllo")
  if(lang == "hi"){
    recognitaion.lang = "hi-IN";
  }
  else{
    recognitaion.lang = "en-IN";
  }
  recognitaion.onresult = function(event) {
    console.log(event);
    document.getElementById('captcha_code').value = document.getElementById('captcha_code').value + event.results[0][0].transcript;
  }
  recognitaion.start();
}

</script>
<script>
  function getAudio() {
    var txt = jQuery('#txt').val()
    jQuery.ajax({
      //url:'../audio_operations/questionnaire_audio.php',
      //url:'http://localhost/captcha-alternative/backend/audio_operations/questionnaire_audio.php',
      url: base_url + "backend/audio_operations/word_chain_audio.php",
      type: 'post',
      success: function(result) {
        jQuery('#ca-player').html(result);
      }
    });
  }
</script>

<div id='arrow'></div>
<script>
  function disp(str) {
    //alert(str);
    document.getElementById('arrow').innerHTML = str;
  }
  document.onkeydown = function(e) {

    /*if ((window.event.metaKey || window.event.ctrlKey) && ( String.fromCharCode(window.event.which).toLowerCase() === 'e') ) {
      window.event.preventDefault()
        console.log( "You pressed CTRL + m");
        $("#captcha_code").focus();

    }
    if ((window.event.metaKey || window.event.ctrlKey) && ( String.fromCharCode(window.event.which).toLowerCase() === 'y') ) {
      window.event.preventDefault()

        console.log( "You pressed CTRL + y" );
        $("#submit").click();

    }
    if ((window.event.metaKey || window.event.ctrlKey) && ( String.fromCharCode(window.event.which).toLowerCase() === 'l') ) {
      window.event.preventDefault()

        console.log( "You pressed CTRL + u" );
        $("#switch_lang").click();

    }
    if ((window.event.metaKey || window.event.ctrlKey) && ( String.fromCharCode(window.event.which).toLowerCase() === 'i') ) {
      window.event.preventDefault()

        console.log( "You pressed CTRL + i" );
        $('#voice_inp').click();

    }
    if ((window.event.metaKey || window.event.ctrlKey) && ( String.fromCharCode(window.event.which).toLowerCase() === 'v') ) {
      window.event.preventDefault()

        console.log( "You pressed CTRL + v" );
        $('#audio').click();

    }*/
    switch (window.event.keyCode) {
      case 87: //w
      window.event.preventDefault();
        console.log("w");
        $("#captcha_code").focus();
        break;
      case 89: //y
      window.event.preventDefault();
      console.log("y");
        $("#submit").click();
        break;
      case 76: //l
      window.event.preventDefault();
      console.log("l");
        $("#switch_lang").click();
        break;

      case 73: //i
      window.event.preventDefault();
      console.log("i");
        $('#voice_inp').click();
        break;
      case 65: //a
      window.event.preventDefault();
      console.log("a");
        $('#audio').click();
        break;

    }
  };
</script>
