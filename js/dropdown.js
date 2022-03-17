$(document).ready(function () {
  // ridimensionamento del contenitore dei filri
  if (checkWidth()) {
    $(".flex-container .aside > div > *").css("width", $(".flex-container .aside").width());
  } else {
    $(".flex-container .aside > div > *").css("width", "initial");
  }

  $(window).resize(function () {
    if (checkWidth()) {
      $(".transform").removeClass("transform-active");
      $("#background").removeClass("background-active");
      $(".btn-settings > img").attr("alt", "filtri ricerca");
      $(".flex-container .aside > div > *").css("width", $(".flex-container .aside").width());
    } else {
      // in caso di rimpoicciolimento della schermata riapro il menu dei filtri nel caso fosse precedentemente aperto
      if ($(".btn-settings").prop("open")) {
        $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/x-icon.svg");
        $(".btn-settings > img").attr("alt", "chiudi filtri ricerca");
        $(".transform").addClass("transform-active");
        $("#background").addClass("background-active");
      } else {
        $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/settings.svg");
        $(".btn-settings > img").attr("alt", "filtri ricerca");
      }
      $(".flex-container .aside > div > *").css("width", "initial");
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
      $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/x-icon.svg");
      $(".btn-settings > img").attr("alt", "chiudi filtri ricerca");
    } else {
      $(".btn-settings > img").attr("src", "/Sanitary_Shop/upload/iconImgs/settings.svg");
      $(".btn-settings > img").attr("alt", "filtri ricerca");
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

  // applicazione dei filtri richiesti dall'utente
  $("li .btn[type=button]").click(() => {
    const url = new URL(window.location.href);

    for ($i = 0; $i < $(".filter-container > ul > li").length - 1; $i++) {
      // elimino dall'indirizzo url i filtri di ricerca non selezionati
      const name_to_delete = [];
      $.each($(".filter-container > ul > li:nth-child(" + ($i + 1) + ") input"), function () {
        name_to_delete.push($(this).attr("name"));
      });

      $.each($.unique(name_to_delete), function (index, element) {
        url.searchParams.delete(element);
      });

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

        $(this).addClass("filter-active");
      });
    }
    // aggiorno l'indirizzo url solo se i filtri di ricerca sono cambiati
    if (url != window.location.href) {
      // modifico l'indirizzo url senza aggiornare la pagina
      history.pushState(null, null, url);

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
