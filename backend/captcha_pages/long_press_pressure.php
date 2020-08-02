<html>
  <head>
   <script>
  function overlay()
	{
    	var cookieValue = document.getElementById("el2").value;    
    	alert("see" + cookieValue);
	}

  </script>
    <style>
    	
	html{
	overflow:hidden;
	}
      .element{
        width: 100%;
        height: 100%;
        padding: 20px;
        background: #FFFFFF;
        top:0px;
    left:0px;
    z-index:1000;
        color: black;
        cursor: pointer;
      }
      div[id*='jquery']{
        background: #FFFFFF;
      }
      h3{
        margin-top: 0;
        margin-bottom: 10px;
      }
      img{
        width: 100%;
      }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  
<script type="text/javascript">
    document.onkeydown = function(event) {
        switch (event.keyCode) {
           case 38:
                $("#btn").focus();
                jQuery.ajax({
                    url:'../audio_operations/enter.php',
                    type:'post',
                    success:function(result){
                        jQuery('#player').html(result);
                    }
                });
              break;
           case 37:
           	$('#guide').focus();
           break;
           case 40:
                 $("#el2").focus();
              break;
              
        }
    };
</script>


    <h1>Pressure Captcha</h1>
   
    <h3>Long Press on below button</h3>
    <button id="guide" autofocus>Guide</button>
    <button  id = "btn">submit</button>
    <div class="element" id="el2" value="0">0</div>
            <div id="player"></div>
    
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="../../dependencies/pressure-master/dist/pressure.js"></script>
    <script type="text/javascript" src="../../dependencies/pressure-master/dist/jquery.pressure.js"></script>
   <script type="text/javascript" src="../../js/long_press_pressure.js"></script>
   
  </body>
  
</html>

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
