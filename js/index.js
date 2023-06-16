$(document).ready(function(){

$.ajax({
    url: "./checksession.php",
    type: 'GET',
    success: function(response) {
      if (response === 'true') {
        $("#iniciarsesion").hide();
        $("#cerrarsesion").show();
        $(".dropdown").show();

      } else {
        $("#iniciarsesion").show();
        $("#cerrarsesion").hide();
        $(".dropdown").hide();
      }
    }
  });
});