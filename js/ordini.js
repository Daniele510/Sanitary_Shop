$(document).ready(function () {
  const timeOut = 9500;

  onResize();

  // update
  setInterval(() => {
    $.get("../../Sanitary_Shop/gestione-storico-ordini.php", { act: "get-new-orders-preview", time: timeOut }, function (data) {
      if (data.length > 0) {
        $("#container_ordini > ul > li").first().before(data);
      }
    });
  }, timeOut);

  const url = new URL(window.location.href);

  const cod = url.searchParams.get("CodOrdine");

  // set notifica current
  let current = 1;
  $("#container_ordini .list-group-item .card input[name='CodOrdine']").each(function (index, element) {
    if (cod == $(element).val()) {
      current = index + 1;
    }
  });
  $("#container_ordini > ul > .list-group-item:nth-child(" + current + ")").addClass("current");
  if(cod){
    if ($(window).width() < 992) {
      $("#box_info_ordine").addClass("col-12");
      moveLeft();
    } else {
      $("#box_info_ordine").addClass("open");
    }
  }


  $("#container_ordini > ul").on("click", ".list-group-item > .card", function (e) {
    if ($(window).width() < 992) {
      $("#box_info_ordine").addClass("col-12");
      moveLeft();
    }

    if (!$(this).parent().hasClass("current")) {
      $("#container_ordini .list-group-item.current").removeClass("current");
      $(this).parent().addClass("current");
      const url = new URL(window.location.href);
      url.searchParams.set(
        "CodOrdine",
        $("#container_ordini > ul > .list-group-item.current .card input[type='hidden']").val()
      );

      history.pushState(null, null, url);

      // prelevare i dati della notifica richiesta dal database
      $.get(
        "gestione-storico-ordini.php",
        {
          act: "get-order-details",
          CodOrdine: $(
            "#container_ordini > ul .list-group-item.current .card input[name='CodOrdine']"
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
      scrollToTargetAdjusted($("#box_info_ordine").offset().top);
      $("#box_info_ordine").focus();
    }
  });

  $("button.back").click(function (e) {
    if ($("#box_info_ordine").hasClass("open") && $(window).width() < 992) {
      moveRight();

      scrollToTargetAdjusted($("#container_ordini .list-group-item.current").first().offset().top);
      $("#container_ordini .list-group-item.current").focus();
    } else {
      window.location = "login.php";
    }
  });

  $(window).resize(function () {
    onResize();
  });

  function moveLeft() {
    const translateX = -(
      $("#container_ordini").width() + parseInt($("#container_ordini").css("gap").split("px")[0])
    );
    $("#box_info_ordine")
      .removeClass("opacity-0")
      .addClass("opacity-100 open")
      .css("transform", "translateX(" + translateX + "px)")
      .css("transition-duration", "2s");

    $("#container_ordini > ul")
      .css("transform", "translateX(" + translateX + "px)")
      .css("transition-duration", "2s")
      .removeClass("opacity-100")
      .addClass("opacity-0");
  }

  function moveRight() {
    $("#container_ordini > ul")
      .removeClass("opacity-0")
      .addClass("opacity-100")
      .css("transform", "translateX(" + 0 + "px)")
      .css("transition-duration", "2s");

    $("#box_info_ordine")
      .css("transform", "translateX(" + 0 + "px)")
      .css("transition-duration", "2s")
      .removeClass("opacity-100 open")
      .addClass("opacity-0");
  }

  function onResize() {
    if ($(window).width() < 992) {
      $("#box_info_ordine").addClass("col-12");

      if ($("#box_info_ordine").hasClass("open")) {
        const translateX = -(
          $("#container_ordini").width() + parseInt($("#container_ordini").css("gap").split("px")[0])
        );
        $("#box_info_ordine")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0ms");

        $("#container_ordini > ul")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0ms")
          .removeClass("opacity-100")
          .addClass("opacity-0");
      } else{
        $("#box_info_ordine")
          .removeClass("opacity-100")
          .addClass("opacity-0")
          .css("transform", "translateX(" + 0 + "px)")
          .css("transition-duration", "0ms")
          .removeClass("col-12");

        $("#container_ordini > ul")
          .css("transform", "translateX(0px)")
          .css("transition-duration", "0ms")
          .removeClass("opacity-0")
          .addClass("opacity-100");
      }
    } else {
      $("#container_ordini > ul")
        .removeClass("opacity-0")
        .addClass("opacity-100")
        .css("transform", "translateX(" + 0 + "px)")
        .css("transition-duration", "0ms");

      $("#box_info_ordine")
        .removeClass("opacity-0")
        .addClass("opacity-100")
        .css("transform", "translateX(" + 0 + "px)")
        .css("transition-duration", "0ms")
        .removeClass("col-12");
    }
  }

  function scrollToTargetAdjusted(top_offset) {
    $("html, body").animate(
      {
        scrollTop: top_offset - 150,
      },
      5
    );
  }
});
