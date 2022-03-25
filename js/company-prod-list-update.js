$(document).ready(function () {
  // aggiorno la lista dei prodotti ogni 15 secondi
  setInterval(function () {
    const url = new URL(window.location.href);

    $.post(
      "../filtri-ricerca.php",
      {
        NomeProdotto: url.searchParams.get("NomeProdotto"),
        "NomeCategoria[]": url.searchParams.getAll("NomeCategoria[]"),
        Order: url.searchParams.get("Order"),
        from: "company"
      },
      function (data) {
        /*
          inserire le possibili nuove carte
          inserire messaggio di errore se il risultato non contiene entry
        */
        if (data.length > 0) {
          $(".list-container").html(data);
        }
      }
    );
  }, 15000);
});
