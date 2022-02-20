$(document).ready(function () {
  if ($("nav ul li a").hasClass("active")) {
    $("nav ul li a.active svg path").attr("fill", "#06acb8");
  }

  $("nav > form").submit(function (event) {
    if ($("nav > form > input").val().length <= 0) {
      event.preventDefault();
    }
  });

  $(".container-fluid > .row:first-child").height($(".container-fluid .header-sticky").height());

  checkWidth();

  $(window).resize(function () {
    checkWidth();
  });

  function checkWidth() {
    //Check condition for screen width
    if ($(window).width() >= 768) {
      $(".navbar-nav").removeAttr("style");
      if ($(".navbar-nav").hasClass("fixed-bottom")) {
        $(".navbar-nav").removeClass("fixed-bottom");
      }
    } else {
      if (!$(".navbar-nav").hasClass("fixed-bottom")) {
        $(".navbar-nav").addClass("fixed-bottom");
      }
    }
  }
});
