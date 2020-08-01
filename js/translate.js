function changeLanguage(e) {
  e.preventDefault();
  $.ajax({
   //url:"../backend/captcha_pages/questionnaire.php",
   url:"../backend/index.php",
   method:"POST",
   data:{"captcha_type" : "questionnaire",
         "lang" : "hi"
        },
   success:function(data) {
     jQuery('#captcha').html(data);
   }
  });
}
