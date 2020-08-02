<?php
require '../config.php';
require '../helpers/add_placeholder.php';
require '../helpers/add_switch_languge.php';
require '../helpers/add_switch_region.php';
require '../helpers/add_buttons.php';
?>
<script type="text/javascript" src=<?php echo $base_url . "js/hammer.js"?>></script>
<link rel="stylesheet" href=<?php echo $base_url . "css/touch.css"?>>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css"?>>
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
    <div class='ca-img-container'>
      <img class='ca-img' id="captcha_image" />
    </div>
    <?php 
      add_buttons();
      //add_switch_language_elem();
    ?>
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
<?php 
error_log($_SESSION['is_open']);
if(isset($_SESSION['is_open']) && $_SESSION['is_open'] == '0') {
  put_placeholder();
}
?>
</div>

<script>
var base_url = "<?php echo $base_url; ?>";
var elem_width = document.getElementsByClassName("ca-panel-body")[0].getBoundingClientRect();
elem_width = elem_width.width;
img_width = elem_width - 20;
$('.ca-img').attr("src", base_url + "backend/image_operations/questionnaire_image.php?id=0&height=40&width=" + img_width);
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

function sendRequest(value) {
  console.log(value);
  $.ajax({
    url: base_url + "backend/validation/touch_validation.php",
    method:"POST",
    data:{code:value},
    success:function(data)
    {
      console.log(data)
      if(data == 'success') {
        v.play();
        alert("Successful Validation");
        var placeholder = document.getElementsByClassName("ca-placeholder-body")[0]; 
        placeholder.style.border = "4px solid green";
        $('.ca-panel-body').hide(1000);
        tick_img = "<img class='ca-val-image' src='" + base_url + "assets/images/tick.jpeg'/>";
        $('.ca-placeholder-body').html(tick_img + "<h3 class='ca-validated'> Captcha Validated</h3>");
      } else {
        i.play();
        alert("Unsuccessful validation");
        //$('#register').attr('disabled', 'disabled');
        //$('#captcha_image').attr('src', 'image.php');
        console.log('Invalid Code');
      }
    }
  });
};
$(document).ready(function(){
  //var touch_sensor = document.querySelector('.touch-sensor');
  var touch_sensor = document.querySelector('body');
  var hammer = new Hammer(touch_sensor);
  var manager = new Hammer.Manager(touch_sensor);
  var hammer = new Hammer(touch_sensor);
// Create a recognizer
  var Tap = new Hammer.Tap({
    taps: 1
  });
  var DoubleTap = new Hammer.Tap({
    event: 'doubletap',
    taps: 2 
  });
  var Swipe = new Hammer.Swipe();

   // Add the recognizer to the manager
  //manager.add(Tap);
  DoubleTap.recognizeWith(Swipe);
  manager.add(Tap);
  manager.add(Swipe);

  // Subscribe to the desired event
  var myVar;
  var n = 0;
  manager.on('tap', function(e) {
    if(isAButton(e.target))  {
      return;
    }
    n = n + 1;
    clearTimeout(myVar);
    myVar = setTimeout(function() {
      console.log('inside');
      console.log(n);
      sendRequest(n);
      n = 0;
    }, 1000);
  });

  manager.on('doubletap', function(e) {
    if(isAButton(e.target))  {
      return;
    }
    console.log('doubletap');
  });

  var deltaX = 0;
  var deltaY = 0;

  manager.on('swipe', function(e) {
    if(isAButton(e.target))  {
      return;
    }
    var direction = e.offsetDirection;
    console.log('swiping ' + direction);
    sendRequest("none");
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
