$(document).ready(function () {

  checkWidth();

  $(window).resize(function () {
    checkWidth();
  });
  
  function checkWidth() {
    //Check condition for screen width
    if ($(window).width() >= 768) {
      if (!$(".grid-container > #notifiche").hasClass("white-column-container")) {
        $(".grid-container > #notifiche").addClass("white-column-container");
      }
    } else {
      if ($(".grid-container > #notifiche").hasClass("white-column-container")) {
        $(".grid-container > #notifiche").removeClass("white-column-container");
      }
    }
  }
});
