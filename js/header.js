$(document).ready(function(){
    if($("nav ul li a").hasClass("active")) {
        $("nav ul li a.active svg path").attr("fill","#06acb8");
    }

    const searchPattern = /.{1,}/;

    $("nav > form").submit(function(event){
        if((!searchPattern.test($("nav > form > input").val()))){
            event.preventDefault();
        }
    });
});