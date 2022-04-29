$(document).ready(function () {
  // aggiorno la lista dei prodotti ogni 15 secondi
  setInterval(function () {
    const url = new URL(window.location.href);

    $.post(
      "./gestione-update-prodotti-categoria.php",
      {
        categoryID: url.searchParams.get("id"),
      },
      function (data) {
        /*
            inserire le possibili nuove carte
            inserire messaggio di errore se il risultato non contiene entry
        */
        if (data.length > 0) {
          $(".list-group").html(data);
        }
      }
    );
  }, 15000);
});
