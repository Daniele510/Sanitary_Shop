$(document).ready(function () {

  $(window).resize(function () {
    if (checkWidth()) {
      $(".transform").removeClass("transform-active");
      $("#background").removeClass("background-active");
      $("body").removeClass("overflow-hidden");
      $(".btn-settings > img").attr("alt", "bottone da cliccare per aprire i filtri di ricerca");
    } else {
      // in caso di rimpicciolimento della schermata riapro il menu dei filtri nel caso fosse precedentemente aperto
      if ($(".btn-settings").prop("open")) {
        $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconsImg/x-icon.svg");
        $(".btn-settings > img").attr("alt", "bottone da cliccare per chiudi i filtri di ricerca");
        $("body").addClass("overflow-hidden");
        $(".transform").addClass("transform-active");
        $("#background").addClass("background-active");
      } else {
        $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconsImg/settings.svg");
        $(".btn-settings > img").attr("alt", "bottone da cliccare per aprire i filtri di ricerca");
      }
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
    $(".btn-settings").prop("open", !$(".btn-settings").prop("open"));
    if ($(".btn-settings").prop("open")) {
      $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconsImg/x-icon.svg");
      $(".btn-settings > img").attr("alt", "bottone da cliccare per chiudere i filtri di ricerca");
    } else {
      $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconsImg/settings.svg");
      $(".btn-settings > img").attr("alt", "bottone da cliccare per aprire i filtri di ricerca");
    }
    $("body").toggleClass("overflow-hidden");
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

  // applicazione dei filtri richiesti dall'utente
  $("li .btn[type=button]").click(() => {
    const url = new URL(window.location.href);

    let name_to_delete;

    for ($i = 0; $i < $(".filter-container > ul > li").length - 1; $i++) {
      // elimino dall'indirizzo url i filtri di ricerca non selezionati
      name_to_delete = [];
      $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input"), function () {
        name_to_delete.push($(this).attr("name"));
      });

      $.each($.unique(name_to_delete), function (index, element) {
        url.searchParams.delete(element);
      });

      // tolgo la classe active dagli input non selezionati
      $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input"), function () {
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
        $(this).addClass("filter-active");
      });
    }

    // aggiorno l'indirizzo url solo se i filtri di ricerca sono cambiati
    if (url != window.location.href) {
      // modifico l'indirizzo url senza aggiornare la pagina
      history.pushState(null, null, url);
      if (/area-aziende/i.test(window.location.href.toString())) {
        $.post(
          "../../Sanitary_Shop/filtri-ricerca.php",
          {
            NomeProdotto: url.searchParams.get("NomeProdotto"),
            "NomeCategoria[]": url.searchParams.getAll("NomeCategoria[]"),
            Order: url.searchParams.get("Order"),
            from: "company",
          },
          function (data) {
            if (data.length > 0) {
              $(".list-container").html(data);
            }
          }
        );
      } else {
        $.post(
          "../../Sanitary_Shop/filtri-ricerca.php",
          {
            NomeProdotto: url.searchParams.get("NomeProdotto"),
            "NomeCompagnia[]": url.searchParams.getAll("NomeCompagnia[]"),
            "NomeCategoria[]": url.searchParams.getAll("NomeCategoria[]"),
            Order: url.searchParams.get("Order"),
          },
          function (data) {
            if (data.length > 0) {
              $(".list-container").html(data);
            }
          }
        );
      }

      if (!checkWidth()) {
        // chiudo il menu dei filtri dopo aver salvato le modifiche
        $(".btn-settings").prop("open", false);
        $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconsImg/settings.svg");
        $(".btn-settings > img").attr("alt", "bottone da cliccare per aprire i filtri di ricerca");
        $(".transform").toggleClass("transform-active");
        $("#background").toggleClass("background-active");
        $("body").toggleClass("overflow-hidden");
      }
    }
  });
});

function checkWidth() {
  //Check condition for screen width
  return $(window).width() >= 768;
}
