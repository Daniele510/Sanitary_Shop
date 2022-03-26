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
        $(form).addClass("needs-confermation");
        $(form).addClass("was-validated");
        $("#confirmForm").modal("show");
        event.preventDefault();
      }
    });
  });
  
  $("form").submit(function (e) { 
    if($(this).hasClass("needs-confermation")){
      $("#confirmForm").modal("show");
      e.preventDefault();
    }
  });
  
  $("#confirmForm .btn-confirm").click(() => {
    $(".was-validated").removeClass("needs-confermation");
    $(".was-validated").trigger("submit");
  });

});
