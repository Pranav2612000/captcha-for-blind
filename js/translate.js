var curr_lang;

function changeLanguage(e, lang, type) {
  e.preventDefault();
  console.log(lang);
  curr_lang = lang;
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

function changeLanguage_press(e, lang, type) {
  e.preventDefault();
  console.log(lang);
  curr_lang = lang;
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
