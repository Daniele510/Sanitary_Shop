// richiesta fatta al di fuori dell'area aziende per richiedere i prodotti di una specifica azienda
$(document).ready(function () {
  // aggiorno la lista dei prodotti ogni 15 secondi
  setInterval(function () {
    const url = new URL(window.location.href);
    
    $.post(
      "./filtri-ricerca.php",
      {
        "IDCompagnia": url.searchParams.get("NomeProdotto"),
        "NomeCategoria[]": url.searchParams.getAll("NomeCategoria[]"),
        Order: url.searchParams.get("Order"),
      },
      function (data) {
        if (data.length > 0) {
          $(".list-group").html(data);
        }
      }
    );
  }, 15000);
});
