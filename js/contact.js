/* check input value */
function check_input(){
  var theForm = document.contact;
  if(theForm.name.value.trim() == ""
    || theForm.email.value.trim() == ""
    || theForm.msg.value.trim() == "") {
      alert('Please fill in all input values');
      return false;
    } else {
      return true;
    }
}
