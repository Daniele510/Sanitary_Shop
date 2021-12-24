$(document).ready(function(){
    if($("nav ul li a").hasClass("active")) {
        $("nav ul li a.active svg path").attr("fill","#06acb8");
    }
});