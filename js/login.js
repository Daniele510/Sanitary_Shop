$(document).ready(function () {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });


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
