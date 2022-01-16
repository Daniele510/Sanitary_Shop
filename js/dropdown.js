$(document).ready(function(){
    $(".btn-settings").click(function(){
        if($(".btn-settings > img").attr("src")==="./upload/x-icon.svg"){
            $(".btn-settings > img").attr("src","./upload/settings.svg");
        } else{
            $(".btn-settings > img").attr("src","./upload/x-icon.svg");
        }
    });
});