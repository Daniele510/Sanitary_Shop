$(document).ready(function(){

    $("#offerteCarousel .carousel-indicators button").first().addClass("active");

    if($("#offerteCarousel .carousel-indicators")[0]){
        $("#offerteCarousel").attr("data-bs-ride","carousel");
    } else{
        $("#offerteCarousel").removeAttr("data-bs-ride");
        $("#offerteCarousel").attr("data-bs-interval","false");
    }

    $("#offerteCarousel .carousel-inner .carousel-item").first().addClass("active");

    $("#carouselProdottiConsigliati .carousel-control-next").click(function(){
        let cardWidth = $("#carouselProdottiConsigliati .carousel-inner .card").width();
        $("#carouselProdottiConsigliati .carousel-inner").scrollLeft($("#carouselProdottiConsigliati .carousel-inner").scrollLeft()+cardWidth);
    });

    $("#carouselProdottiConsigliati .carousel-control-prev").click(function(){
        let cardWidth = $("#carouselProdottiConsigliati .carousel-inner .card").width();
        $("#carouselProdottiConsigliati .carousel-inner").scrollLeft($("#carouselProdottiConsigliati .carousel-inner").scrollLeft()-cardWidth);
    });
    
});