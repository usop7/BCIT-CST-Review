$("#menubtn").click(function(event){
  $("#menucontent").slideToggle();
  var content = document.getElementById("menucontent");
  if (content.className === "menucontent") {
    content.className += " responsive";
    $("header").css("height", "200px");
    $("#article").css("margin-top", "200px");
  } else {
    content.className = "menucontent";
    $("header").css("height", "70px");
    $("#article").css("margin-top", "70px");
  }
});
