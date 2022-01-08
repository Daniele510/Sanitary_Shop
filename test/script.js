$(document).ready(function(){

    $("#carouselProdottiConsigliati .carousel-control-next").click(function(){
        let cardWidth = $("#carouselProdottiConsigliati .carousel-inner .card").width();
        $("#carouselProdottiConsigliati .carousel-inner").scrollLeft($("#carouselProdottiConsigliati .carousel-inner").scrollLeft()+cardWidth);
    });

    $("#carouselProdottiConsigliati .carousel-control-prev").click(function(){
        let cardWidth = $("#carouselProdottiConsigliati .carousel-inner .card").width();
        $("#carouselProdottiConsigliati .carousel-inner").scrollLeft($("#carouselProdottiConsigliati .carousel-inner").scrollLeft()-cardWidth);
    });

});