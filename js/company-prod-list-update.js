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
        from: "company",
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

  // seggerimento prodotti di un'azienda con delay
  const updateSuggestion = throttle((text) => {
    // chiamata ajax al db
    $.post("../../Sanitary_Shop/gestione-suggerimenti.php", { NomeProdotto: text, from: "company" }, function (data) {
      const data_parse = JSON.parse(data);

      if (Object.keys(data_parse).length > 0) {
        $("#suggestions").html(data_parse["productsSeggestion"]);
      } else {
        $("#suggestions").html("");
      }
    });
  });

  $('input[type="search"]').on("input", (e) => {
    if (e.target.value.length > 0) {
      updateSuggestion(e.target.value);
    } else {
      $("#suggestions").html("");
    }
  });

  function throttle(cb, delay = 1000) {
    let shouldWait = false;
    let waitingArgs;
    const timeoutFunc = () => {
      if (waitingArgs == null) {
        shouldWait = false;
      } else {
        cb(...waitingArgs);
        waitingArgs = null;
        setTimeout(timeoutFunc, delay);
      }
    };

    return (...args) => {
      if (shouldWait) {
        waitingArgs = args;
        return;
      }

      cb(...args);
      shouldWait = true;

      setTimeout(timeoutFunc, delay);
    };
  }
});
