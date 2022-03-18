$(document).ready(function () {
  setInterval(() => {
    $.post("notification.php", {action: "get-count-notifiche"}, function (data) {
      if (/login.php/i.test(window.location.href.toString)) {
        if (data >= 0) {
          $("#notifiche > a > img").attr("src", "../../Sanitary_Shop/upload/iconsImg/active-bell.svg");
        } else {
          $("#notifiche > a > img").attr("src", "../../Sanitary_Shop/upload/iconsImg/bell.svg");
        }
      } else {
        // modificare l'icona di login in header
      }
    });
  }, 5000);
});
