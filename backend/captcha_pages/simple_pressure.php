<?php
require '../config.php';
require '../helpers/add_placeholder.php';
require '../helpers/add_switch_languge.php';
require '../helpers/add_switch_region.php';
?>
<script type="text/javascript" src="../dependencies/pressure-master/dist/pressure.js"></script>
<script type="text/javascript" src="../dependencies/pressure-master/dist/jquery.pressure.js"></script>

<link rel="stylesheet" href=<?php echo $base_url . "css/questionnaire.css"?>>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css"?>>
<script src= <?php echo $base_url ."js/translate.js"?>/>
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

<div class="ca-panel-body">
  <form method="post" id="captcha_form">
    <label class='ca-label'>Pressure Captcha</label>
    <div class='ca-img-container'>
      <img src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=0&width=400&height=40"; ?> id="captcha_image" />
    </div>
    <button class='ca-button'  name="audio" id="audio" value="Audio" onclick="getAudio(event)" autofocus ><?php print $_SESSION["audio"]; ?></button>
    <button class='ca-button' type="submit" name="register" id="change_captcha" value="use gesture captcha" onclick="switchCaptcha(event, 'gesture')">Gesture</button>
    <button class='ca-button' type="submit" name="register" id="change_captcha" value="use pressure captcha" onclick="switchCaptcha(event, 'pressure')">Pressure</button>
    <button class='ca-button' type="submit" name="register" id="submit" value="Check" ><?php print $_SESSION["check"]; ?></button>
    <button class='ca-button' id='switch_lang' onclick="changeLanguage(event, 'pressure')">Switch language</button>

    <?php 
      add_switch_language_elem("pressure");
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
    <div id="player"></div>
  </form>
</div>



<script>
var base_url = "<?php echo $base_url; ?>";
var v = document.getElementById("valid"); 
var i = document.getElementById("invalid"); 
var e = document.getElementById("enter"); 
var is_open = "<?php echo $_SESSION['is_open']; ?>";
var body = document.getElementsByClassName('ca-panel-body')[0];
console.log(body);
console.log(is_open);
console.log(!is_open);
if(is_open == '0') {
  console.log('hreer');
  body.style.display="none";
}
$.pressureConfig({
  polyfill: false
});

var s = 0;
var block = {
  start: function(event){
    console.log(event);
    if(isAButton(event.target)) {
      return;
    }
    console.log('start', event);
    s = 0;
  },

  change: function(force, event){
    console.log(event);
    if(isAButton(event.target)) {
      return;
    }
    // event.preventDefault();
    //this.style.width = Pressure.map(force, 0, 1, 200, 300) + 'px';
    s = force;
    console.log('change', force);
    //console.log('mahi' + s);
  },

  startDeepPress: function(event){
    console.log(event);
    if(isAButton(event.target)) {
      return;
    }
    console.log('start deep press', event);
  },

  /*endDeepPress: function(){
    console.log('end deep press');
    this.style.backgroundColor = '#0080FF';
  },*/
	
   end: function(e){
    console.log(e);
    /*
    if(isAButton(e.target)) {
      return;
    }
    */
    if(s == 0) {
      console.log('returing');
      return;
    }
    $.ajax({
      url: base_url + "backend/validation/pressure_validation.php",
      method:"POST",
      data:{code:s},
      success:function(data)
      {
        console.log(data)
        if(data == 'success') {
          v.play();
          alert("Successful Validation");
          $('.ca-panel-body').html("<h3 class='ca-validated'> Captcha Validated</h3>");
          //$('#register').attr('disabled', false);
        } else {
          i.play();
          alert("Unsuccessful validation");
          //$('#register').attr('disabled', 'disabled');
          //$('#captcha_image').attr('src', 'image.php');
          console.log('Invalid Code');
        }
      }
    });
   },
  /*end: function(){
    console.log('end');
    this.style.width = '200px';
    this.innerHTML = 0;
  },*/

  unsupported: function(){
    console.log(this);
    this.innerHTML = 'Your device / browser does not support this :(';
  }
}
Pressure.set($('body'), block, {only: 'mouse', polyfill: true, polyfillSpeedUp: 2000});
</script>

<div id='arrow'></div>
<script>
  function disp(str) {
    //alert(str);
    document.getElementById('arrow').innerHTML = str;
  }
</script>
