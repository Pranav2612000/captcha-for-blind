function changeLanguage(e, type, lang) {
  e.preventDefault();
  lang = document.getElementById('lang').value;
  console.log(lang);
  $.ajax({
   //url:"../backend/captcha_pages/questionnaire.php",
   url:"../backend/index.php",
   method:"POST",
   data:{"captcha_type" : type,
         "lang" : lang,
         "open" : '1',
        },
   success:function(data) {
     jQuery('#captcha').html(data);
   }
  });
}

function changeLanguage_press(e,type, lang) {
  e.preventDefault();
  console.log(lang);
  $.ajax({
   //url:"../backend/captcha_pages/questionnaire.php",
   url:"../backend/index.php",
   method:"POST",
   data:{
        "captcha_type" : type,
         "lang" : lang,
         "open" : '1',
        },
   success:function(data) {
     jQuery('#captcha').html(data);
   }
  });
}
