$(document).ready(function () {
  const timeOut = 9500;

  onResize();

  // update
  setInterval(() => {
    $.get("../../Sanitary_Shop/gestione-notifiche.php", { act: "get-new-notifications-preview", time: timeOut }, function (data) {
      if (data.length > 0) {
        $("#container_notifiche > ul > li").first().before(data);
      }
    });
  }, timeOut);

  const url = new URL(window.location.href);

  const cod = url.searchParams.get("CodNotifica");

  // set notifica current
  let current = 1;
  $("#container_notifiche .list-group-item .card input[name='CodNotifica']").each(function (index, element) {
    if (cod == $(element).val()) {
      current = index + 1;
    }
  });
  $("#container_notifiche .list-group-item:nth-child(" + current + ")").addClass("current");

  $("#container_notifiche > ul").on("click", ".list-group-item > .card", function (e) {
    if ($(window).width() < 992) {
      $("#box_notifica").addClass("col-12");
      moveLeft();
    }

    if (!$(this).parent().hasClass("current")) {
      $("#container_notifiche .list-group-item.current").removeClass("current");
      $(this).parent().addClass("current");
      const url = new URL(window.location.href);
      url.searchParams.set(
        "CodNotifica",
        $("#container_notifiche .list-group-item.current .card input[type='hidden']").val()
      );

      history.pushState(null, null, url);

      // prelevare i dati della notifica richiesta dal database
      $.get(
        "../../Sanitary_Shop/gestione-notifiche.php",
        {
          act: "get-notification",
          CodNotifica: $("#container_notifiche .list-group-item.current .card input[type='hidden']").val(),
        },
        function (data) {
          if (data.length > 0) {
            $("#box_notifica > div").html(data);
          }
        }
      );
      scrollToTargetAdjusted($("#box_notifica").offset().top);
      $("#box_notifica").focus();
    }
  });

  $("button.back").click(function (e) {
    if ($("#box_notifica").hasClass("open")) {
      moveRight();

      scrollToTargetAdjusted($("#container_notifiche .list-group-item.current").first().offset().top);
      $("#container_notifiche .list-group-item.current").focus();
    } else {
      window.location = "login.php";
    }
  });

  $(window).resize(function () {
    onResize();
  });

  function moveLeft() {
    const translateX = -(
      $("#container_notifiche").width() + parseInt($("#container_notifiche").css("gap").split("px")[0])
    );
    $("#box_notifica")
      .removeClass("opacity-0")
      .addClass("opacity-100 open")
      .css("transform", "translateX(" + translateX + "px)")
      .css("transition-duration", "2s");

    $("#container_notifiche > ul")
      .css("transform", "translateX(" + translateX + "px)")
      .css("transition-duration", "2s")
      .removeClass("opacity-100")
      .addClass("opacity-0");
  }

  function moveRight() {
    $("#container_notifiche > ul")
      .removeClass("opacity-0")
      .addClass("opacity-100")
      .css("transform", "translateX(" + 0 + "px)")
      .css("transition-duration", "2s");

    $("#box_notifica")
      .css("transform", "translateX(" + 0 + "px)")
      .css("transition-duration", "2s")
      .removeClass("opacity-100 open")
      .addClass("opacity-0");
  }

  function onResize() {
    if ($(window).width() < 992) {
      $("#box_notifica").addClass("col-12");

      if ($("#box_notifica").hasClass("open")) {
        const translateX = -(
          $("#container_notifiche").width() + parseInt($("#container_notifiche").css("gap").split("px")[0])
        );
        $("#box_notifica")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0ms");

        $("#container_notifiche > ul")
          .css("transform", "translateX(" + translateX + "px)")
          .css("transition-duration", "0ms")
          .removeClass("opacity-100")
          .addClass("opacity-0");
      }
    } else {
      $("#container_notifiche > ul")
        .removeClass("opacity-0")
        .addClass("opacity-100")
        .css("transform", "translateX(" + 0 + "px)")
        .css("transition-duration", "0ms");

      $("#box_notifica")
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
