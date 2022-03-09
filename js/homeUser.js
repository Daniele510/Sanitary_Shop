$(document).ready(function () {
  _array = [];
  for (let i = 0; i < $("#offerteCarousel .carousel-item").length; i++) {
    _array.push($($("#offerteCarousel .carousel-item:nth-child(" + (i + 1) + ")")).height());
  }
  $("#offerteCarousel .carousel-item > .card").height(Math.max.apply(Math, _array));

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

  $(window).resize(function () {
    _array = [];
    for (let i = 0; i < $("#offerteCarousel .carousel-item").length; i++) {
      _array.push($($("#offerteCarousel .carousel-item:nth-child(" + (i + 1) + ")")).height());
    }
    $("#offerteCarousel .carousel-item > .card").height(Math.max.apply(Math, _array));
  });
});
