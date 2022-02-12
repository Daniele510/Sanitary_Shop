$(document).ready(function(){
    $(".btn-settings").click(function(){
        if($(".btn-settings > img").attr("src")==="./upload/x-icon.svg"){
            $(".btn-settings > img").attr("src","./upload/settings.svg");
            $(".btn-settings > img").attr("alt","filtri ricerca");
        } else{
            $(".btn-settings > img").attr("src","./upload/x-icon.svg");
            $(".btn-settings > img").attr("alt", "chiudi filtri ricerca");
        }
        $(".transform").toggleClass("transform-active");
        $("#background").toggleClass("background-active");
    });
});