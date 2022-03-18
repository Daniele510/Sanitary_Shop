$(document).ready(function () {
  setInterval(() => {
    $.post("notification.php", {action: "get-info"}, function (data) {
      const data_parse = JSON.parse(data);
      // aggiornamento dati utente
      $("#info-addr > p").html(data_parse["info_addr"]);
      $("#info-carta > p").html(data_parse["info_carta"]);

      // aggiornamento sesione notifiche
      if ((notifiche = data_parse["notifiche"]).lenght > 0) {
        $("#notifiche > div > ul").html(notifiche);
      } else {
        $("#notifiche > div > ul").html(
          '<li class="alert alert-info text-center mb-0" role="alert"> \
              Non hai notifiche \
          </li>'
        );
      }
    });
  }, 5000);
});
