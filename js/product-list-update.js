$(document).ready(function () {
  // aggiorno la lista dei prodotti ogni 15 secondi
  setInterval(function () {
    const url = new URL(window.location.href);

    $.post(
      "./filtri-ricerca.php",
      {
        NomeProdotto: url.searchParams.get("NomeProdotto"),
        "NomeCompagnia[]": url.searchParams.getAll("NomeCompagnia[]"),
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
