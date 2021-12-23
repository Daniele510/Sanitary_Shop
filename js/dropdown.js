$(document).ready(function(){
    $(".btn-settings").click(function(){
        if($(".btn-settings > img").attr("src")==="./upload/x-icon.svg"){
            $(".btn-settings > img").attr("src","./upload/settings.svg");
        } else{
            console.log($(".btn-settings > img").attr("src"));
            $(".btn-settings > img").attr("src","./upload/x-icon.svg");
        }
    });
});