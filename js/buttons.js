var in_scope = true;
function myFunction(e) {
    e.preventDefault();
    in_scope = false;
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('#switch_lang')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    in_scope = true;
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}