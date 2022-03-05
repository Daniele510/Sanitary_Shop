$(document).ready(function () {
  if (checkWidth()) {
    $(".grid-container .aside > *").css("max-width", $(".grid-container .aside").width());
  } else {
    $(".grid-container .aside > *").css("max-width", "initial");
  }

  $(window).resize(function () {
    if (checkWidth()) {
      $(".grid-container .aside > *").css("max-width", $(".grid-container .aside").width());
    } else {
      $(".grid-container .aside > *").css("max-width", "initial");
    }
  });

  // annullo le modifiche nel caso non venga premuto il bottone di salvataggio
  for ($i = 0; $i < $(".filter-container > ul > li").length - 1; $i++) {
    $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input"), function () {
      if (!$(this).hasClass("filter-active")) {
        $(this).prop("checked", false);
      } else {
        $(this).prop("checked", true);
      }
    });
  }

  $(".btn-settings").click(function () {
    if ($(".btn-settings > img").attr("src") === "/Sanitary_Shop/upload/iconImgs/x-icon.svg") {
      $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/settings.svg");
      $(".btn-settings > img").attr("alt", "filtri ricerca");
    } else {
      $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/x-icon.svg");
      $(".btn-settings > img").attr("alt", "chiudi filtri ricerca");
    }
    $(".transform").toggleClass("transform-active");
    $("#background").toggleClass("background-active");
    // annullo le modifiche nel caso non venga premuto il bottone di salvataggio
    for ($i = 0; $i < $(".filter-container > ul > li").length - 1; $i++) {
      $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input"), function () {
        if (!$(this).hasClass("filter-active")) {
          $(this).prop("checked", false);
        } else {
          $(this).prop("checked", true);
        }
      });
    }
  });

  $("li .btn").click(() => {
    const url = new URL(window.location.href);

    for ($i = 0; $i < $(".filter-container > ul > li").length - 1; $i++) {
      // elimino dall'indirizzo url i filtri di ricerca non selezionati
      url.searchParams.delete(
        $(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input:not(:checked)").attr("name")
      );
      // tolgo la classe active dagli input non selezionati
      $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input:not(:checked)"), function () {
        $(this).removeClass("filter-active");
      });
      // aggiungo i valori degli input selezionati all'indirizzo url
      $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input:checked"), function () {
        // controllo se è già stato inserito il filtro sotto osservazione nella url; in caso negato lo aggiungo
        if ($i == 0 && !url.searchParams.getAll($(this).attr("name")).toString().includes($(this).val())) {
          url.searchParams.append($(this).attr("name"), $(this).val());
        } else {
          url.searchParams.set($(this).attr("name"), $(this).val());
        }
        // aggiungo la classe active agli input selezionati in modo da annullare le modifiche ai filtri di ricerca se non viene premutp il bottone per salvarle
        $(this).addClass("filter-active");
      });
    }
    // aggiorno l'indirizzo url solo se i filtri di ricerca sono cambiati
    if (url != window.location.href) {
      // modifico l'indirizzo url senza aggiornare la pagina
      history.pushState(null, null, url);
      $.post(
        "/Sanitary_Shop/filtri-ricerca.php",
        {
          NomeProdotto: url.searchParams.get("NomeProdotto"),
          "NomeCompagnia[]": url.searchParams.getAll("NomeCompagnia[]"),
          "NomeCategoria[]": url.searchParams.getAll("NomeCategoria[]"),
          Order: url.searchParams.get("Order"),
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
      if (!checkWidth()) {
        // chiudo il menu dei filtri dopo aver salvato le modifiche
        $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/settings.svg");
        $(".btn-settings > img").attr("alt", "filtri ricerca");
        $(".transform").toggleClass("transform-active");
        $("#background").toggleClass("background-active");
      }
    }
  });
});

function checkWidth() {
  //Check condition for screen width
  return $(window).width() >= 768;
}
