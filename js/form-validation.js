$(document).ready(function () {
  "use strict";

  // Loop over them and prevent submission
  $(".needs-validation").submit(function (event) {
      Array.prototype.slice.call($(".needs-validation")).forEach(function (form) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          $(form).find(".invalid-feedback").hide();
          $(form).find("input:invalid").first().focus();
          $(form).find("input:invalid + .invalid-feedback").first().show();
          return false;
        } else {
          $(form).removeClass("needs-validation");
          $(form).addClass("was-validated");
          $(form).removeAttr("novalidate");
        }
      });
  });
});