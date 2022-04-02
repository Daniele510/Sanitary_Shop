$(document).ready(function () {
  if (!/login.php/i.test(window.location.href.toString())) {
    switchUserIcon();
  }

  setInterval(() => {
    if (/login.php/i.test(window.location.href.toString())) {
      $.post("../../Sanitary_Shop/login-home-update.php", {action: "get-info"}, function (data) {
        const data_parse = JSON.parse(data);

        if (Object.keys(data_parse).length > 0) {
          // aggiornamento dati utente
          $("#info-addr .container > p").html(data_parse["info_addr"]);
          $("#info-carta .container > p").html(data_parse["info_carta"]);

          // aggiornamento sezione notifiche
          if ((notifiche = data_parse["notifiche"]).length > 0) {
            $("#notifiche > div > ul").html(notifiche);
            $("#notifiche > a > img").attr("src", "../../Sanitary_Shop/upload/iconsImg/active-bell.svg");
          } else {
            $("#notifiche > div > ul").html(
              '<li class="alert alert-info text-center mb-0" role="alert"> \
                Non hai notifiche \
              </li>'
            );
            $("#notifiche > a > img").attr("src", "../../Sanitary_Shop/upload/iconsImg/bell.svg");
          }
        }
      });
    } else {
      switchUserIcon();
    }
  }, 10000);

  // cambia l'icona user se ci sono nuove notifiche
  function switchUserIcon() {
    $.post("../../Sanitary_Shop/login-home-update.php", {action: "get-count-notifiche"}, function (data) {
      const data_parse = JSON.parse(data);

      if (Object.keys(data_parse).length > 0 && data_parse["numero_notifiche"] > 0) {
        $("#login_link svg").html(
          '<title id="login-icon">' +
            data_parse["title"] +
            '</title> \
            <path d="M28.0001 26.4442C30.499 26.4441 32.9218 25.5846 34.862 24.0098C36.8021 22.435 38.1416 20.2408 38.6557 17.7953C37.2545 16.4879 36.2019 14.8513 35.5935 13.034C34.985 11.2167 34.8399 9.27626 35.1712 7.38868C33.8489 6.22248 32.2631 5.39483 30.5502 4.97687C28.8373 4.55891 27.0485 4.56315 25.3377 4.98922C23.6268 5.41528 22.0449 6.25044 20.7281 7.42289C19.4113 8.59535 18.3988 10.07 17.7778 11.7202C17.1568 13.3704 16.9458 15.1466 17.163 16.8964C17.3801 18.6461 18.0189 20.3169 19.0244 21.7653C20.0299 23.2136 21.3721 24.3961 22.9355 25.2111C24.499 26.0261 26.237 26.4493 28.0001 26.4442Z" fill="#324B4B"/> \
            <path d="M46.6665 17.1112C50.962 17.1112 54.4442 13.629 54.4442 9.33344C54.4442 5.03789 50.962 1.55566 46.6665 1.55566C42.3709 1.55566 38.8887 5.03789 38.8887 9.33344C38.8887 13.629 42.3709 17.1112 46.6665 17.1112Z" fill="#06ACB8"/> \
            <path d="M49 48.9997H46.6667H7V46.6663C7 37.662 14.3267 30.333 23.3333 30.333H32.6667C41.671 30.333 49 37.662 49 46.6663V48.9997Z" fill="#324B4B"/>'
        );
      } else {
        $("#login_link svg").html(
          '<title id="login-icon">' +
            data_parse["title"] +
            '</title> \
            <rect width="56" height="56" rx="10" fill="none" /> \
            <path d="M17.5 15.1665C17.5 20.9555 22.211 25.6665 28 25.6665C33.789 25.6665 38.5 20.9555 38.5 15.1665C38.5 9.3775 33.789 4.6665 28 4.6665C22.211 4.6665 17.5 9.3775 17.5 15.1665ZM46.6667 48.9998H49V46.6665C49 37.6622 41.671 30.3332 32.6667 30.3332H23.3333C14.3267 30.3332 7 37.6622 7 46.6665V48.9998H46.6667Z" fill="#324B4B" />'
        );
      }
    });
  }
});
