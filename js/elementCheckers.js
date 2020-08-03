function isAButton(ele) {
  console.log(ele);
  if(isToBeIgnored(ele)) {
    return true;
  }
  var buttons = document.getElementsByClassName('ca-button');
  var buttons_array = [...buttons];
  console.log(buttons_array);
  if (buttons_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}

function isAInput(ele) {
  var inputs = document.getElementsByTagName('input');
  var inputs_array = [...inputs];
  if (inputs_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}

function isToBeIgnored(ele) {
  var ignores = document.getElementsByClassName('ca-ignore');
  var ignores_array = [...ignores];
  if (ignores_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}

function isABtnIcon(ele) {
  var btnicons = document.getElementsByClassName('ca-btn-icon');
  var btnicons_array = [...btnicons];
  if (btnicons_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}
