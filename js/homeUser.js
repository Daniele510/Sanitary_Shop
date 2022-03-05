$(document).ready(function () {
  setEqualHeight();

  $("#carouselProdottiConsigliati .carousel-control-next").click(function () {
    let cardWidth = $("#carouselProdottiConsigliati .carousel-inner .card").width();
    $("#carouselProdottiConsigliati .carousel-inner").scrollLeft(
      $("#carouselProdottiConsigliati .carousel-inner").scrollLeft() + cardWidth
    );
  });

  $("#carouselProdottiConsigliati .carousel-control-prev").click(function () {
    let cardWidth = $("#carouselProdottiConsigliati .carousel-inner .card").width();
    $("#carouselProdottiConsigliati .carousel-inner").scrollLeft(
      $("#carouselProdottiConsigliati .carousel-inner").scrollLeft() - cardWidth
    );
  });

  $(window).resize(() => {
    setEqualHeight();
  });

  function setEqualHeight() {
    let _array = [];
    // reset dell'altezza delle card del carousel per le offerte
    $("#offerteCarousel .carousel-item .card").css("min-height", "0");

    // ricerca dell'altezza massima fra gli oggetti del carousel per le offerte
    $("#offerteCarousel .carousel-item").each(function () {
      _array.push($(this).outerHeight());
    });

    // set della stessa altezza per tutti gli oggetti del carousel per le offerte
    $("#offerteCarousel .carousel-item .card").css("min-height", Math.max.apply(null, _array));
  }
});
