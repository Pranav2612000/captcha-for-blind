<?php
require '../config.php';
?>
<link rel="stylesheet" href=<?php echo $base_url . "css/questionnaire.css"?>>
<link rel="stylesheet" href=<?php echo $base_url . "css/common.css"?>>
<script src= <?php echo $base_url ."js/translate.js"?>/>

<div class="ca-panel-body">
  <form method="post" id="captcha_form">
    <canvas id="ca-canvas"></canvas> 
    <label class='ca-label'>Draw a </label>
    <div class='ca-img-container'>
      <img class='ca-img' src=<?php echo $base_url . "backend/image_operations/questionnaire_image.php?id=0&height=40&width=200"; ?> id="captcha_image" />
    </div>
    <button class='ca-button' id='switch_lang' onclick="changeLanguage(event, 'object_detection')">Switch language</button>
    <input type="button" name="audio" id="audio" class="ca-button" value="Audio" onclick="getAudio()" autofocus/>
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

var canvas = document.getElementById('ca-canvas');
var ctx = canvas.getContext('2d');
resize();
var pos = { x: 0, y: 0 };
var v = document.getElementById("valid"); 
var i = document.getElementById("invalid"); 
var e = document.getElementById("enter"); 

window.addEventListener('resize', resize);
document.addEventListener('mousemove', draw);
document.addEventListener('mousedown', setPositionAndClear);
document.addEventListener('mouseenter', setPosition);
document.addEventListener('mouseup', stopDrawing);
document.getElementsByClassName("ca-button")[0].addEventListener("click", function(){
  console.log('button pressed');
});

// new position from mouse event
// function setPosition(e) {
//   pos.x = e.clientX;
//     pos.y = e.clientY;
//     }
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

function setPosition(e) {
  pos.x = e.clientX;
  pos.y = e.clientY;
  //pos.x = e.offsetX;
  //pos.y = e.offsetY;
}
function setPositionAndClear(e) {
  setPosition(e);
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}
function bringCanvasFront() {
  canvas.style.zIndex = "99";
  console.log("bring canvas front");
}
function takeCanvasBack() {
  canvas.style.zIndex = "-1";
  console.log("take canbas back");
}
function stopDrawing(e) {
  console.log(e);
  if(canvas.style.zIndex == "-1") {
    return;
  }
  takeCanvasBack();
  if(isAButton(e.target)) {
    return;
  }
  setPosition(e);
  var image = canvas.toDataURL("image/jpg");
  /*
  var link = document.createElement('a');
  link.setAttribute("type", "hidden"); // make it hidden if needed
  link.download = 'canvasimg';
  link.href = image;
  document.body.appendChild(link);
  link.click();
  link.remove();
  */
  $.ajax({
    url: base_url + "backend/validation/object_detection.php",
    method:"POST",
    data:{img:image},
    success:function(data)
    {
      console.log(data)
      if(data == 'success') {
        v.play();
        alert("Successful Validation");
        $('.ca-panel-body').html("<h3 class='ca-validated'> Captcha Validated</h3>");
        $('#canvas').hide();
        document.removeEventListener('mousemove', draw);
        document.removeEventListener('mousedown', setPositionAndClear);
        document.removeEventListener('mouseenter', setPosition);
        document.removeEventListener('mouseup', stopDrawing);
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
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}
function resize() {
  //ctx.canvas.width = window.innerWidth;
  //ctx.canvas.height = window.innerHeight;
  //ctx.canvas.width = 28;
  //ctx.canvas.height = 28;
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  console.log('resizing');

}

function draw(e) {
  if (e.buttons !== 1) return;
  if(isAButton(e.target)) {
    return;
  }
  bringCanvasFront();
  ctx.beginPath(); // begin
  ctx.lineWidth = 5;
  ctx.lineCap = 'round';
  ctx.strokeStyle = 'rgb(255,0,0)';
  ctx.moveTo(pos.x, pos.y); // from
  setPosition(e);
  ctx.lineTo(pos.x, pos.y); // to
  ctx.stroke(); // draw it!
}

function isAButton(ele) {
  console.log(ele);
  var buttons = document.getElementsByClassName('ca-button');
  var buttons_array = [...buttons];
  if (buttons_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}

</script>

<div id='arrow'></div>
<script>
  function disp(str) {
    //alert(str);
    document.getElementById('arrow').innerHTML = str;
  }
  document.onkeydown = function(e) {

    if ((window.event.metaKey || window.event.ctrlKey) && ( String.fromCharCode(window.event.which).toLowerCase() === 'e') ) {
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

    }
    /*switch (window.event.keyCode) {
      case 49: //left arrow
        $("#captcha_code").focus();
        break;
      case 50: //left arrow
        $("#submit").focus();
        break;
      case 51: //up arrow
        $("#switch_lang").focus();
        break;

      case 52: //right key
        $('#voice_inp').focus();
        break;
      case 53: //down key
        $('#audio').focus();
        break;

    }*/
  };
</script>
