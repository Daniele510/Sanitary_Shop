$(document).ready(function () {
  const timeOut = 9500;

  onResize();

  // update
  setInterval(() => {
    $.get(
      "gestione-storico-ordini.php",
      { act: "get-new-orders-preview", time: timeOut },
      function (data) {
        if(data.length > 0){
          $("#container_ordini > div > ul > li").first().before(data);
        }
      }
    );
  }, timeOut);

  const url = new URL(window.location.href);

  const cod = url.searchParams.get("CodOrdine");

  // set ordine current
  let current = 1;
  $("#container_ordini > div > ul .list-group-item .card input[name='CodOrdine']").each(function (
    index,
    element
  ) {
    if (cod == $(element).val()) {
      current = index + 1;
    }
  });
  $("#container_ordini > div > ul .list-group-item:nth-child(" + current + ")").addClass("current");

  // trigger animazione di scroll da preview ordini -> dettaglio ordine e richiesta, se necessario, dei dettagli dell'ordine richiesto al db
  $("#container_ordini > div > ul").on("click", ".list-group-item > .card", function (e) {
    if (!$(this).parent().hasClass("current")) {
      $("#container_ordini > div > ul .list-group-item.current").removeClass("current");
      $(this).parent().addClass("current");

      // prelevare i dati della notifica richiesta dal database
      $.get(
        "gestione-storico-ordini.php",
        {
          act: "get-order-details",
          CodOrdine: $(
            "#container_ordini > div > ul .list-group-item.current .card input[name='CodOrdine']"
          ).val(),
        },
        function (data) {
          const data_parse = JSON.parse(data);
          if (Object.keys(data_parse).length > 0) {
            $("#box_info_ordine > div > div").html(data_parse["dettagli-ordine"]);
            $("#box_lista_prodotti > ul").html(data_parse["lista-prodotti"]);
          }
        }
      );
    }

    // eseguo l'animazione di scroll da preview ordini -> dettaglio ordine
    if ($(window).width() < 768) {
      $("#box_info_ordine").addClass("col-12");
      moveLeftSmallScreen();
    }

    // aggiorno l'url in modo che contentga solo il codice dell'ordine sotto osservazione
    const url = new URL(window.location.href);
    url.searchParams.delete("CodFornitore");
    url.searchParams.delete("CodProdotto");
    url.searchParams.set(
      "CodOrdine",
      $("#container_ordini > div > ul .list-group-item.current .card input[name='CodOrdine']").val()
    );
    history.pushState(null, null, url);

    /* 
    aggiusto la posizione della scroll bar della pagina in modo da visualizzare correttamente la sezione 
    del dettaglio ordine
    */
    scrollToTargetAdjusted($("#box_info_ordine").offset().top);
    $("#box_info_ordine").addClass("open");
    $("#box_info_ordine").focus();
  });

  // trigger animazione di scroll da preview dettaglio ordine -> prodotto e richiesta, se necessario, del prodotto richiesto al db
  /* .click only works for elements already on the page. */
  $("#box_lista_prodotti").on("click", ".card", function () {
    if (!$(this).parent().hasClass("current")) {
      $("#box_lista_prodotti .list-group-item.current").removeClass("current");
      $(this).parent().addClass("current");

      $.get(
        "gestione-storico-ordini.php",
        {
          act: "get-product",
          CodOrdine: $(
            "#container_ordini > div > ul .list-group-item.current .card input[name='CodOrdine']"
          ).val(),
          CodProdotto: $(
            "#box_info_ordine .list-group-item.current .card input[type='hidden'][name='CodProdotto']"
          ).val(),
          CodFornitore: $(
            "#box_info_ordine .list-group-item.current .card input[type='hidden'][name='CodFornitore']"
          ).val(),
        },
        function (data) {
          const data_parse = JSON.parse(data);
          if (Object.keys(data_parse).length > 0) {
            $("#box_prodotto > div").html(data_parse);
          }
        }
      );
    }
    const url = new URL(window.location.href);
    url.searchParams.set(
      "CodOrdine",
      $("#container_ordini > div > ul .list-group-item.current .card input[name='CodOrdine']").val()
    );
    url.searchParams.set(
      "CodProdotto",
      $("#box_info_ordine .list-group-item.current .card input[type='hidden'][name='CodProdotto']").val()
    );
    url.searchParams.set(
      "CodFornitore",
      $("#box_info_ordine .list-group-item.current .card input[type='hidden'][name='CodFornitore']").val()
    );
    history.pushState(null, null, url);

    // eseguo animazione di scroll da preview dettaglio ordine -> prodotto
    if ($(window).width() < 768) {
      moveLeftSmallScreen();
    } else {
      moveLeftMidScreen();
    }
    $("#box_info_ordine").removeClass("open");
    scrollToTargetAdjusted($("#box_prodotto").offset().top);
  });

  // trigger animazione go back
  $("button.back").click(function (e) {
    if ($("#box_info_ordine").hasClass("open") || $("#box_prodotto").hasClass("open")) {
      if ($(window).width() < 768) {
        moveRightSmallScreen();
      } else {
        moveRightMidScreen();
      }
      if ($("#box_info_ordine").hasClass("open")) {
        const url = new URL(window.location.href);
        url.searchParams.delete("CodFornitore");
        url.searchParams.delete("CodProdotto");
        history.pushState(null, null, url);
        scrollToTargetAdjusted($("#box_info_ordine .list-group-item.current").first().offset().top);
        $("#box_info_ordine .list-group-item.current").first().focus();
      } else {
        scrollToTargetAdjusted(
          $("#container_ordini > div > ul .list-group-item.current").first().offset().top
        );
        $("#container_ordini > div > ul .list-group-item.current").first().focus();
      }
    } else {
      window.location = "login.php";
    }
  });

  $(window).resize(function () {
    onResize();
  });

  function moveLeftMidScreen() {
    const translateX = -(
      $("#container_ordini").width() + parseInt($("#container_ordini").css("gap").split("px")[0])
    );
    $("#box_prodotto")
      .removeClass("opacity-0")
      .addClass("opacity-100 open")
      .css("transform", "translateX(" + translateX + "px)")
      .css("transition-duration", "2s");

    $("#container_ordini > div")
      .css("transform", "translateX(" + translateX + "px)")
      .css("transition-duration", "2s")
      .removeClass("opacity-100")
      .addClass("opacity-0");
  }

  function moveRightMidScreen() {
    $("#container_ordini > div")
      .removeClass("opacity-0")
      .addClass("opacity-100")
      .css({ transform: "translateX(" + 0 + "px)", "transition-duration": "2s" });

    if ($("#box_info_ordine").hasClass("open")) {
      $("#box_info_ordine").removeClass("open");
    } else {
      $("#box_info_ordine").addClass("open");
    }

    $("#box_prodotto")
      .css({ transform: " translateX(" + 0 + "px)", "transition-duration": "2s" })
      .removeClass("opacity-100 open")
      .addClass("opacity-0");
  }

  function moveLeftSmallScreen() {
    let translateX = -(
      $("#container_ordini").width() + parseInt($("#container_ordini").css("gap").split("px")[0])
    );
    if (!$("#box_info_ordine").hasClass("open") && !$("#box_prodotto").hasClass("open")) {
      $("#box_info_ordine")
        .removeClass("opacity-0")
        .addClass("opacity-100 open")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#box_prodotto")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s")
        .addClass("opacity-0");

      $("#container_ordini > div > ul")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s")
        .addClass("opacity-0");
    } else {
      translateX *= 2;

      $("#box_info_ordine")
        .removeClass("opacity-100 open")
        .addClass("opacity-0")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#box_prodotto")
        .removeClass("opacity-0")
        .addClass("opacity-100 open")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#container_ordini > div > ul")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s")
        .addClass("opacity-0");
    }
  }

  function moveRightSmallScreen() {
    let translateX = -(
      $("#container_ordini").width() + parseInt($("#container_ordini").css("gap").split("px")[0])
    );

    if ($("#box_prodotto").hasClass("open")) {
      $("#box_info_ordine")
        .removeClass("opacity-0")
        .addClass("opacity-100 open")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#box_prodotto")
        .removeClass("opacity-100 open")
        .addClass("opacity-0")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#container_ordini > div > ul")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s")
        .addClass("opacity-0");
    } else if ($("#box_info_ordine").hasClass("open")) {
      translateX = 0;
      $("#box_prodotto")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#box_info_ordine")
        .removeClass("opacity-100 open")
        .addClass("opacity-0")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");

      $("#container_ordini > div > ul")
        .removeClass("opacity-0")
        .addClass("opacity-100")
        .css("transform", "translateX(" + translateX + "px)")
        .css("transition-duration", "2s");
    }
  }

  function scrollToTargetAdjusted(top_offset) {
    $("html, body").animate(
      {
        scrollTop: top_offset - 300,
      },
      5
    );
  }

  function onResize() {
    const translateX = -(
      $("#container_ordini").width() + parseInt($("#container_ordini").css("gap").split("px")[0])
    );

    if ($(window).width() < 768) {
      $("#container_ordini > div").addClass("d-contents");

      $("#box_info_ordine").addClass("col-12");

      if ($("#box_prodotto").hasClass("open")) {
        $("#container_ordini > div").css("transform", "translateX(" + translateX + "px)");

        $("#box_prodotto")
          .css("transform", "translateX(" + translateX * 2 + "px)")
          .css("transition-duration", "0ms");

        $("#container_ordini > div > *")
          .css("transform", "translateX(" + translateX * 2 + "px)")
          .css("transition-duration", "0ms")
          .removeClass("opacity-100")
          .addClass("opacity-0");
      } else if ($("#box_info_ordine").hasClass("open")) {
        $("#box_prodotto")
          .addClass("opacity-0")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0s");

        $("#box_info_ordine")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0s");

        $("#container_ordini > div > ul")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0s")
          .addClass("opacity-0");
      } else {
        $("#container_ordini > *, #container_ordini > div > *:not(#container_ordini > div > ul)")
          .addClass("opacity-0")
          .removeClass("opacity-100");
        $("#container_ordini > *").css("transform", "translateX(0px)");
      }
    } else {
      $("#container_ordini > div").removeClass("d-contents");

      $("#box_info_ordine").removeClass("col-12");

      $("#container_ordini > div > *")
        .removeClass("opacity-0")
        .addClass("opacity-100")
        .css("transform", "translateX(0px)");

      if ($("#box_prodotto").hasClass("open")) {
        $("#box_prodotto")
          .addClass("opacity-100")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0s");

        $("#container_ordini > div")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0s")
          .addClass("opacity-0");
      } else {
        $("#container_ordini > div")
          .removeClass("opacity-0")
          .addClass("opacity-100")
          .css("transform", "translateX(" + 0 + "px)")
          .css("transition-duration", "0s");

        $("#box_prodotto")
          .css("transform", "translateX(" + 0 + "px)")
          .css("transition-duration", "0s")
          .removeClass("opacity-100")
          .addClass("opacity-0");
      }
    }
  }
});
