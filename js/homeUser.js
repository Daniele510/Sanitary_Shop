$(document).ready(function(){

    $("#offerteCarousel .carousel-indicators button").first().addClass("active");

    if($("#offerteCarousel .carousel-indicators")[0]){
        $("#offerteCarousel").attr("data-bs-ride","carousel");
    } else{
        $("#offerteCarousel").removeAttr("data-bs-ride");
        $("#offerteCarousel").attr("data-bs-interval","false");
    }

    $("#offerteCarousel .carousel-inner .carousel-item").first().addClass("active");

    $("#carouselProdottiConsigliati .carousel-inner .carousel-item").first().addClass("active");

});