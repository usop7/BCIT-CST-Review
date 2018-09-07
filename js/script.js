/* check input value */
function check_input(){
  var theForm = document.rate_form;
  if(theForm.password.value == ""
    || theForm.description.value == ""
    || theForm.instructor.value == ""
    || theForm.score.value == 0) {
      alert('Please fill in all input values');
      return false;
    } else {
      return true;
    }
}

/* level rating */
var onStar;
function level(){

  /* color of stars */
  var color;
  if(onStar < 3) {
    color = 'green';
  } else if (onStar < 5) {
    color = 'orange';
  } else {
    color = '#bf4931';
  }
  /* level text msg */
  var result;
  switch(onStar){
    case 1:
      result = 'Show up & pass';
      break;
    case 2:
      result = 'Easy';
      break;
    case 3:
      result = 'Moderate';
      break;
    case 4:
      result = 'Tough, a lot of work';
      break;
    case 5:
      result = '&nbsp; Hardest, better be prepared';
      break;
  }

  var i = 1;
  while(i <= onStar) {
    $('#level' + i).css('background-color', color);
    i++;
  }
  var j = 5;
  while(j > onStar) {
    $('#level' + j).css('background-color', '#cccdce');
    j--;
  }
  $('#score').attr("value", onStar);
  $('#div-score').html(onStar);
  $('#div-score').css('color', color);
  $('#level-text').html(result);
  $('#level-text').css('color', color);
}

/* level rating */
$('.level').on('click', function(){
  onStar = parseInt($(this).data('value'));
  $('.post-detail').css('display', 'block');
  level();
});
