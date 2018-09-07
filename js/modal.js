$(document).ready(function(){

  var modal = document.getElementById('modal');
  var span = document.getElementById('close');
  var id;

  $(".morebtn").click(function(e){
    modal.style.display = "block";
    $("#listid").val($(this).prevAll("input").val());
  });

  $(".modal-content button").click(function(e){
    e.preventDefault();

    id = $("#listid").val();
    var source = e.target.id;
    var password = $("#password").val();
    $.ajax({
      url: "check_process.php",
      type: "POST",
      data: {id: id, job: source, password: password},
      success: function(result) {
        if (result == "deleted") {
          alert("Successfully deleted");
          window.location.reload();
        } else if(result == "edit") {
          $("#editform").submit();
        } else {
          $("#check_result").html(result);
        }
      }

    });


  });

  // when user clicks on <span> (X), close the modal
  span.onclick = function() {
    modal.style.display = "none";
    $("#check_result").html("&nbsp;");
  }
  // when user clicks anywhere outside of the modal, close it
  modal.onclick = function(event){
    //console.log(event.target.id);
    if (event.target.id == 'modal') {
      modal.style.display = "none";
      $("#check_result").html("&nbsp;");
    }
  }

});
