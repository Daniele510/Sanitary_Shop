$(document).ready(function () {
  // aggiorno la lista dei prodotti ogni 2 secondi
  setInterval(function () {
    const url = new URL(window.location.href);

    $.post(
      "../filtri-ricerca.php",
      {
        NomeProdotto: url.searchParams.get("NomeProdotto"),
        "NomeCompagnia[]": url.searchParams.getAll("NomeCompagnia[]"),
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
          $(".container-list").html(data);
        }
      }
    );
  }, 1000);
});
