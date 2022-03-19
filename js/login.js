$(document).ready(function () {

  checkWidth();

  $(window).resize(function () {
    checkWidth();
  });
  
  function checkWidth() {
    //Check condition for screen width
    if ($(window).width() >= 768) {
      if (!$(".grid-container > #notifiche").hasClass("container")) {
        $(".grid-container > #notifiche").addClass("container");
      }
    } else {
      if ($(".grid-container > #notifiche").hasClass("container")) {
        $(".grid-container > #notifiche").removeClass("container");
      }
    }
  }
});
