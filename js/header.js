$(document).ready(function () {

  $("nav > form").submit(function (event) {
    if ($("nav > form > input").val().length <= 0) {
      event.preventDefault();
    }
  });

  $(".container-fluid > .row:first-child").height($(".container-fluid .header-sticky").height());

  updateHeaderOnResize($(window).width());

  $(window).resize(function () {
    updateHeaderOnResize($(window).width());
  });

  function updateHeaderOnResize(width) {
    if (width >= 768) {
      $(".navbar-nav").removeAttr("style");
      if ($(".navbar-nav").hasClass("small-screen")) {
        $(".navbar-nav").removeClass("small-screen");
        $(".navbar-nav").removeClass("fixed-bottom");
        $(".navbar-nav").removeClass("bg-white");
      }
    } else {
      if (!$(".navbar-nav").hasClass("small-screen")) {
        $(".navbar-nav").addClass("small-screen");
        $(".navbar-nav").addClass("fixed-bottom");
        $(".navbar-nav").addClass("bg-white");
      }
    }
  }
});
